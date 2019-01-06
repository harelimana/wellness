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
     * @param $name
     * @param $subject
     * @param $sendto
     * @return mixed
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function mailling(Prestataire $name, $subject, $sendto)
    {
        $message = (new \Swift_Message('Hello :', $name->getName()))
            ->setFrom('bloemoide@gmail.com')
            ->setTo($sendto) //'recipient.harelimana@gmail.com'
            ->setReplyTo($name->getEmail()) //'recipient.harelimana@gmail.com'
            ->setSubject($subject)
            ->setBody(
                $this->renderer->render(
                // templates/emails/registrationreply.html.twig
                    'emails/registrationreply.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
        ;

        $this->mailer->send($message);

        return $this->renderer->render('security/registration/registrationSuccess.html.twig',['name'=>$name]); //not required but useful
    }
}