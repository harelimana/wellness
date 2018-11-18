<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadImage extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $data = Factory::create();

        for($i=0; $i<10; $i++) {
            $image = new Image();
            $image->setImage($data->imageUrl());
            $image->setOrdre(rand(1, 5));
            $manager->persist($image);
            $this->addReference('image-' . $i, $image);
        }

        for($i=0; $i<10; $i++) {
            $logo = new Image();
            $logo->setImage($data->imageUrl());
            $logo->setOrdre(rand(1, 5));
            $manager->persist($logo);
            $this->addReference('logo-' . $i, $logo);
        }

        $manager->flush();
    }
    public function getOrder(){
        return 1;
    }
}
