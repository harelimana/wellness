<?php

namespace App\Notifications;

use App\Entity\Prestataire;
use Swift_mailer;
use Twig\Environment;

class RegistrationNotifications{

    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(Swift_mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    /**
     * @param $name
     * @param $subject
     * @param $sendto
     * @param Swift_Mailer $mailer
     * @return mixed
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function mailling(Prestataire $name, $subject, $sendto, Swift_Mailer $mailer)
    {
        $sendto = 'bloemoide@gmail.com';
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('bloemoide@gmail.com')
            ->setTo($sendto) //'recipient.harelimana@gmail.com'
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

        $mailer->send($message);

        return $this->renderer->render('mail sent to : ' . $name); //not required but useful
    }
}