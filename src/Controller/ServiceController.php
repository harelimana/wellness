<?php

namespace App\Controller;

use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="service")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository(Service::class);
        $services = $service->findAll();
        return $this->render('service/index.html.twig', [
            'service' => $services,
        ]);
    }
}
