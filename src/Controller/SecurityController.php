<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\User;
use App\Form\PrestataireType;
use App\Notifications\RegistrationNotifications;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{

    /**
     * @Route("/registration", name="security_signin")
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @param RegistrationNotifications $notification
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, RegistrationNotifications $notification)
    {
        $sendto = "bloemoide@gmail.com";
        $subject = "coucou, this is a mail about Symfony project";
        $prestataire = new Prestataire();
        $form = $this->createForm(PrestataireType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cryptogram = $encoder->encodePassword($prestataire,$prestataire->getPassword());  // you can get error if the class doesn't implements the UserInterface and the requireds methods (see User)
            $prestataire->setPassword($cryptogram);
            $notification->mailling($prestataire,$sendto,$subject,$mail = null);
            $manager->persist($prestataire);
            $manager->flush();

            return $this->redirectToRoute('service');
        }
        return $this->render('security/registration/registrate.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @route("/connexion", name="securitylogin")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signIn(){
        return $this->render('security/login.html.twig');
    }

    /**
     * @route("/deconnexion", name="securitylogout")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signOut(){
        return $this->render('security/logout.html.twig');
    }

}
