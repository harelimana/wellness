<?php

namespace App\DataFixtures;

use App\Entity\Stage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadStage extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $data = Factory::create('fr_BE');

        for ($i = 0; $i < 10; $i++) {
            $stage = new Stage();
            $stage->setName($data->name);
            $stage->setDescription($data->text);
            $stage->setAffichageDebut($data->dateTime);
            $stage->setAffichageFin($data->dateTime);
            $stage->setDebutstage($data->dateTime);
            $stage->setFinStage($data->dateTime);
            $stage->setMoreInfo($data->text);
            $stage->setTarif($data->NumberBetween(20, 500));
            $stage->addPrestataire($this->getReference('prestataire' . rand(1, 8)));
            $manager->persist($stage);

            $this->setReference("stage" . $i, $stage);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [LoadPrestataire::class];
    }
}
