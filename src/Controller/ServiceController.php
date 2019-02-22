<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function detailsServiceByIdD($id)
    {
        $services = $this->getDoctrine()
            ->getRepository(Service::class)
            ->find($id);
        if (isset($services) !== false) {
            return $this->render('/service/details/serviceDetails.html.twig', ['service' => $services]);
        } else {
            return $this->redirectToRoute('service');
        }
    }

    /**
     * @Route("/serviceDetails/{slug}", name="serviceDetails")
     * @param $slug
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function detailsService($slug)
    {
        $services = $this->getDoctrine()
            ->getRepository(Service::class)
            ->findBySlug($slug);
        if (isset($services) !== false) {
            return $this->render('/service/details/serviceDescription.html.twig', ['service' => $services]);
        } else {
            return $this->redirectToRoute('service');
        }
    }

    /**
     * @Route("/servicesByPrestataire/{slug}", name="servicesPrestataire")
     * @param $slug
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function listServicesByPrestataire($arg = 74){
        $services = $this->getDoctrine()->getRepository(Prestataire::class);
        $services->findServicesByPrestataire($arg);
        if (isset($services) !== false) {
            return $this->render('/service/details/servicesByPrestaire.html.twig', ['service' => $services]);
        } else {
            return $this->redirectToRoute('service');
        }
    }
}
