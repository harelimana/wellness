<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\User;
use App\Form\PrestataireType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index()
    {
        return $this->render('users/services.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    /**
     * @Route ("/signin", name="signin")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function signIn(Prestataire $presta = null, Request $request)
    {
        if(!$presta){
            $presta = new Prestataire();
        }

        $form = $this->createForm(PrestataireType::class, $presta, ['method' => 'POST']);
        $form->handleRequest($request);

        // check if the authenticating user already exist

        $doctrine = $this->getDoctrine();
        $email = $presta->getEmail();
        $existingUser = $doctrine->getRepository('App:User')->findBy(['email' => $email]);

        if ($existingUser) {
            $this->addFlash('notice', 'This email already in use !');
            return $this->redirectToRoute('signin');
        }

        // if the user passes

        if ($form->isSubmitted() && ($form->isValid())) {

            $password = $presta->getPassword();
                        $presta->setPassword($password);

            $em = $doctrine->getManager();
            $em->persist($presta);

            $this->addFlash('success', 'Authentication successfull !');

            return $this->redirectToRoute('signin');
        }
        // render

        return $this->render('users/authenticate/signIn.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
