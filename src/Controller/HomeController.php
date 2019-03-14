<?php

namespace App\Controller;

use App\Entity\Internaute;
use App\Entity\Prestataire;
use App\Entity\Service;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $prestataire = $em->getRepository(Prestataire::class);
        $lastPresta = $prestataire->lastHiredPrestataire();

        return $this->render('prestataire/list/lastHiredPresta.html.twig',['listLastPrestataire' => $lastPresta]);
    }

    /**
     * @Route("/admin/prestataires", name="admin.prestataires")
     */
    public function prestataires()
    {
        $prestataires = $this->getDoctrine()->getRepository(Prestataire::class)->findAll();
        return $this->render('admin/prestataires/index.html.twig', ['prestataires' => $prestataires, 'controller' => 'prestataires']);
    }
    /**
     * @Route("/admin/internautes", name="admin.internautes")
     */
    public function surfers()
    {
        $surfers = $this->getDoctrine()->getRepository(Internaute::class)->findAll();
        return $this->render('admin/internautes/index.html.twig', ['internautes' => $internautes, 'controller' => 'internautes']);
    }

    /**
     * @Route("/admin/services", name="admin.services")
     */
    public function services()
    {
        $services = $this->getDoctrine()->getRepository(Service::class)->findAll();
        return $this->render('admin/services/index.html.twig', ['services' => $services, 'controller' => 'services']);
    }
}
