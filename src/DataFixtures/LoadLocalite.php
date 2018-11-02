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
        // $localite = new Localite();
        // $manager->persist($localite);
        $data= Factory::create();
        for($i=0; $i<10; $i++){
            $localite = new Localite();
            $localite->setLocalite($data->city);

            $manager->persist($localite);
            $this->addReference("localite" . $i, $localite);
        }

        $manager->flush();
    }
}
