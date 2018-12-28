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
     * @Route("/serviceByPresta/{id}", name="serviceByPresta")
     * @param $id
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function detailsService($id)
    {
        $em = $this->getDoctrine()->getRepository(Prestataire::class);
        $prestataire = $em->find($id);

        if (isset($prestataire) == false) {
            return $this->redirectToRoute('service');

        } else {
            $services = $prestataire->serviceByPrestataire($id);
            return $this->render('/service/details/serviceDescription.html.twig', ['service' => $services]);

        }
    }

}
