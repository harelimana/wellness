<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\Service;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $prestataire = $em->getRepository(Prestataire::class);
        $lastPresta = $prestataire->lastHiredPrestataire();

        return $this->render('prestataire/list/lastHiredPresta.html.twig',['listLastPrestataire' => $lastPresta]);
    }
}
