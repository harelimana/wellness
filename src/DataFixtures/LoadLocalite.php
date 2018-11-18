<?php

namespace App\DataFixtures;

use App\Entity\Localite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadLocalite extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $data= Factory::create();
        for($i=1; $i<=10; $i++){
            $localite = new Localite();
            $localite->setLocalite($data->unique()->city);

            $manager->persist($localite);
            $this->setReference('localite-' . $i, $localite);
        }

        $manager->flush();
    }
}
