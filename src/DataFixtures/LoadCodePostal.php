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
        // $cp = new CodePostal();
        // $manager->persist($cp);

        $data= Factory::create("fr_BE");
        for($i=0; $i<10; $i++){
            $cp = new CodePostal();
            $cp->setCodePostal($data->postcode);

            $manager->persist($cp);
            $this->addReference("cp" . $i, $cp);
        }

        $manager->flush();
    }
}
