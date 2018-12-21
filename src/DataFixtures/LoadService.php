<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Prestataire;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadService extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $data = Factory::create('fr_BE');

        for ($i = 0; $i < 10; $i++) {
            $service = new Service();
          //  $prestataire = new Prestataire();
            $service->setName($data->name);
            $service->setDescription($data->text);
            $service->setEnAvant($data->boolean);
            $service->setValide($data->boolean);
            $service->setSlug($data->slug);
         //   $service->addPrestataire($this->getReference('prestataire' . rand(1,8)));

            $manager->persist($service);

            $this->setReference("service" . $i, $service);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [LoadPrestataire::class];
    }
}
