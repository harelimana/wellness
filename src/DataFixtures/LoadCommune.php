<?php

namespace App\DataFixtures;

use App\Entity\Commune;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadCommune extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Commune = new Commune();
        // $manager->persist($commune);

        $data= Factory::create("fr_BE");
        for($i=0; $i<10; $i++){
            $commune = new Commune();
            $commune->setCommune($data->city);

            $manager->persist($commune);
            $this->addReference("commune" . $i, $commune);
        }

        $manager->flush();
    }
}
