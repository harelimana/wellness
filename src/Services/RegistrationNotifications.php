<?php

namespace App\Notifications;

use App\Entity\Prestataire;
use Swift_mailer;
use Twig\Environment;

class RegistrationNotifications{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    /**
     * @param $prestataire
     * @param $subject
     * @param $sendto
     * @return mixed
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function mailling(Prestataire $prestataire, $subject, $sendto)
    {
        $sendto = "bloemoide@gmail.com";
        $message = (new \Swift_Message('Hello :', $prestataire->getName()))
            ->setFrom('bloemoide@gmail.com')
            ->setTo($sendto) //'recipient.harelimana@gmail.com'
            ->setReplyTo($prestataire->getEmail()) //'recipient.harelimana@gmail.com'
            ->setSubject($subject)
            ->setBody(
                $this->renderer->render(
                // templates/emails/registrationreply.html.twig
                    'emails/registrationreply.html.twig',
                    array('name' => $prestataire)
                ),
                'text/html'
            )
        ;

        $this->mailer->send($message);

        return $this->renderer->render('security/registration/registrationSuccess.html.twig',['name'=>$prestataire]); //not required but useful
    }
}