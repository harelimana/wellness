<?php

namespace App\DataFixtures;

use App\Entity\CodePostal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadCodePostal extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $data= Factory::create('fr_BE');
        for($i=1; $i<=10; $i++){
            $cp = new CodePostal();
            $cp->setCodePostal($data->numberBetween(1000,9000));

            $manager->persist($cp);
            $this->setReference('cp'. $i , $cp);
        }

        $manager->flush();
    }
}
