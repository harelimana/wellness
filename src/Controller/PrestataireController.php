<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\User;
use App\Form\PrestataireType;
use App\Repository\PrestataireRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PrestataireController extends AbstractController
{
    /**
     * @Route("/prestataire", name="prestataire")
     */
    public function index()
    {
        return $this->render('prestataire/index.html.twig', [
            'controller_name' => 'PrestataireController',
        ]);
    }

    /**
     * @Route("/listprestataire", name="listprestataire")
     */
    public function findSome(){
        $em = $this->getDoctrine()->getManager();
        $prestataire = $em->getRepository(Prestataire::class);
        $listPrestataire = $prestataire->findAll();
        return $this->render('prestataire/prestataire.html.twig', [
            'prestataire' => $listPrestataire,
        ]);
    }

    /**
     * @Route("/addprestataire", name="createPrestatire")
     * @param Prestataire $prestataire
     * @param Request $request
     * @param ObjectManager $manager
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addPrestataire(Prestataire $prestataire, Request $request, ObjectManager $manager){
        if (!$prestataire) {
            $prestataire = new Prestataire();
        }
        $form = $this->createForm(PrestataireType::class);
        /** si le formulaire a été soumis et qu'il est valide */
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prestataire);
            $em->flush();
            return $this->redirectToRoute('listprestataire', ['id' => $prestataire->getId()]);
        }
        return $this->render('prestataire/addPrestaire.html.twig',
            ['formedit' => $form->createView()]
        );
    }

    /**
     * @Route("/prestataire/{slug}", name="detailsPrestataire")
     * @param $slug
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function detailsPrestataire($slug)
    {
        $manager = $this->getDoctrine()
                        ->getRepository('App:Prestataire');
        $prestataire = $manager->findOneBy(['slug' => $slug]);

        if (isset($prestataire) == false) {
            return $this->redirectToRoute('detailsPrestataireErrors');

        } else {
            return $this->render('prestataire/prestataireDetailsSuccess.html.twig',
                ['prestataire' => $prestataire]);
        }
    }

    /**
     * Route("/prestataire/{$id}", name="servicesPrestataire")
     * @param $id
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getServicesByPrestataire($id){
        $prestataire = $this->getDoctrine()
            ->getRepository(Prestataire::class)
            ->find($id);

        if (isset($prestataire) == false) {
            return $this->redirectToRoute('detailsPrestataireErrors');

        } else {
            $services = $prestataire->getServices();
            return $this->render('prestataire/servicesByPresta.html.twig',
                ['services' => $services]);
        }
    }

    /**
     * @Route("/servicesprestataire/{id}", name="servicesPrestataire")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * this method uses the PrestataireRepository
     */

    public function show($id)
    {
        $prestataire = $this->getDoctrine()
            ->getRepository(Prestataire::class)
            ->findOneByIdJoinedToServices($id);

        $services = $prestataire->getServices();
        return $this->render('prestataire/servicesByPresta.html.twig',
            ['services' => $services]);

    }
}
