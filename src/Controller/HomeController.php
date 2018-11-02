<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $prestataire = $em->getRepository(Prestataire::class);
        $service = $em->getRepository(Service::class);
        $listPrestataire = $prestataire->findAll();
        $listService = $service->findAll();
        $services = $service->findAll();

        return $this->render('service/service.html.twig', ['service'=>$services,
            'listPrestataire' => $listPrestataire,'listService'=>$listService
        ]);
    }
}
