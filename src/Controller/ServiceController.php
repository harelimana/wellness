<?php

namespace App\Controller;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="service")
     */
    public function index()
    {
        $ems = $this->getDoctrine()->getManager();
        $service = $ems->getRepository(Service::class);
        $services = $service->findAll();
        return $this->render('service/index.html.twig', [
            'service' => $services,
        ]);
    }

    /**
     * @Route("/details_service/{id}", name="service_details")
     */
    public function detailsAction($id)
    {
        $services = $this->getDoctrine()
            ->getRepository(Service::class)
            ->find($id);
        return $this->render('service/details/details_services.html.twig', array(
            'service' => $services
        ));
    }

    /**
     * display a given service details according its provided slug
     * @Route("/service/{id}", name="sluggedServiceDetails")
     */
    public function detailsService($id)
    {
        $services = $this->getDoctrine()->getRepository(Service::class)
                                        ->findBy($id);

        if (isset($services) == false) {
            return $this->redirectToRoute('service unfound');

        } else {
            return $this->render('/service/details/serviceDescription.html.twig', ['service' => $services]);
        }
    }

}
