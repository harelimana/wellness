<?php
/**
 * Created by PhpStorm.
 * User: axxahretz
 * Date: 19.01.19
 * Time: 18:03
 */

namespace App\Services;


use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SliderManager extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sliderMonitor()
    {
        $doctrine = $this->getDoctrine();
        $services = $doctrine->getRepository(ServiceRepository::class);
        $servicesforecast = $services->miseEnAvant();

        /*  some checks in the VIEW Module */

        return $this->render('/Slider/slider.html.twig', ['servicesForecast'=>$servicesforecast]);
    }

}