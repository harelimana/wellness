<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\User;
use App\Form\PrestataireType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/registration", name="security_signin")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $presta = new Prestataire();
        $form = $this->createForm(PrestataireType::class, $presta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($presta,$presta->getPassword());  // you can get erro if the class doesn't implements the UserInterface and the requireds methods (see User)
            $presta->setPassword($hash);
         //   $presta->getPassword();
            $manager->persist($presta);
            $manager->flush();

            return $this->redirectToRoute('securitylogin');
        }
        return $this->render('security/index.html.twig', [
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
