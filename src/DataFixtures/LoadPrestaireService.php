<?php

namespace App\DataFixtures;

use App\Entity\Prestataire;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPrestaireService extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
     /*   $presta_service = new prestaire_service();

        for ($i=0;$i<10;$i++){
            $presta_service->addService($this->getReference('service' . rand(1, 8)));
            $presta_service->addPrestataire($this->getReference('prestataire' . rand(1, 8)));
        }

        $manager->flush(); */
    }
  /*  public function getDependencies()
    {
        return [LoadService::class,LoadPrestataire::class];
    } */
}
