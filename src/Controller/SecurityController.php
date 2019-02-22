<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Internaute;
use App\Entity\Prestataire;
use App\Entity\User;
use App\Form\ImageType;
use App\Form\InternauteType;
use App\Form\LoginType;
use App\Form\PrestataireType;
use App\Form\ResetPasswordType;
use App\Repository\UserRepository;
use App\Services\RegistrationNotifications;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        // $sendfrom = "bloemoide@gmail.com";
        $subject = "coucou, this is a mail about Symfony project";

        $prestataire = new Prestataire();
        $form = $this->createForm(PrestataireType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cryptogram = $encoder->encodePassword($prestataire, $prestataire->getPassword());  // you can get error if the class doesn't implements the UserInterface and the requireds methods (see User)
            $prestataire->setPassword($cryptogram);
            $notification->mailling($prestataire, $subject, $sendto);
            $manager->persist($prestataire);
            $manager->flush();

            return $this->redirectToRoute('service');
        }
        return $this->render('security/registration/registrate.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @route("/firstsignin", name="preregistration")
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @param RegistrationNotifications $notification
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function preRegistration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, RegistrationNotifications $notification)
    {
        $newInternaute = new Internaute();

        $form = $this->createForm(InternauteType::class, $newInternaute);
        $form->handleRequest($request);

        $email = $newInternaute->getEmail();
        $userExist = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$email]);

        if ($form->isSubmitted() && ($form->isValid())) {

            if (!$userExist) {

                $cryptogram = $encoder->encodePassword($newInternaute, $newInternaute->getPassword());  // you can get error if the class doesn't implements the UserInterface and the requireds methods (see User)
                $newInternaute->setPassword($cryptogram);

                $notification->mailling($newInternaute, $subject, $sendto);

                $manager->persist($newInternaute);
                $manager->flush();

            } else {
                $this->addFlash('notice', 'Sorry ! This address is in use !');
                return $this->redirectToRoute('preregistration');
            }

        }
        return $this->render('security/registration/preRegistration.html.twig', [
            'form' => $form->createView()]);
    }

    /**
     * @route("/connexion", name="securitylogin")
     * @param Request $request
     * @param ObjectManager $om
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signIn(Request $request, ObjectManager $om, AuthenticationUtils $authenticationUtils): Response
    {
        $prestataire = new Prestataire();
        $form = $this->createForm(LoginType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($prestataire);
            $om->flush();
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error]);
        /*  'form' => $form->createView()
             'error' => $error ]); */
    }

    /**
     * @route("/deconnexion", name="securitylogout")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signOut()
    {
        return $this->render('security/logout.html.twig');
    }

}
