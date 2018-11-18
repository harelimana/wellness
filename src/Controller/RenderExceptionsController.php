<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RenderExceptionsController extends AbstractController
{
    /**
     * @Route("/render/exceptions", name="render_exceptions")
     */
    public function index()
    {
        return $this->render('render_exceptions/index.html.twig', [
            'controller_name' => 'RenderExceptionsController',
        ]);
    }

    /**
     * @Route("/detailsPrestatairesErrors",name="detailsPrestataireErrors")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPrestaDetailsErrors(){
        $errorMessage = ['msg'=>'unfound Prestataire !'];
        return $this->render('prestataire/index.html.twig', ['error' => $errorMessage]);
    }
}
