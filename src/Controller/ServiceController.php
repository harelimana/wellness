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
        return $this->render('service/services.html.twig', [
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
     * @param Service $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/service/{id}", name="identifiedServiceDetails")
     */
    public function detailsService($id)
    {
        $service = $this->getDoctrine()->getRepository(Service::class)
            ->find($id);

        if (isset($services) == false) {
            return $this->redirectToRoute('service');

        } else {

            return $this->render('/service/details/serviceDescription.html.twig', ['service' => $service]);

        }
    }

}
