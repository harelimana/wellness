<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Prestataire;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadService extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $data = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $service = new Service();

            $service->setName($data->name);
            $service->setDescription($data->text);
            $service->setEnAvant($data->boolean);
            $service->setValide($data->boolean);
            $image = new Image();
            
            $prestataire = new Prestataire();

            $image->setImage($data->text());
            $image->setOrdre(rand(1,5));

            $manager->persist($image);
            $manager->persist($service);
            $manager->persist($prestataire);


            $this->addReference("service" . $i, $service);
        }

        $manager->flush();
    }
}
