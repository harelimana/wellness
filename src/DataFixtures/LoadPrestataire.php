<?php

namespace App\DataFixtures;

use App\Entity\Commune;
use App\Entity\Image;
use App\Entity\Localite;
use App\Entity\Prestataire;
use App\Entity\Service;
use App\Entity\Stage;
use App\Repository\CodePostalRepository;
use App\Repository\ServiceRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\CodePostal;

class LoadPrestataire extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $data = Factory::create('fr_BE');
        $tva = '0.21';

        for ($i = 1; $i <= 5; $i++) {

            $prestataire = new Prestataire();
            $image = new Image();
            $logo = new Prestataire();
            $stage = new Stage();
            $image->setImage('http://placehold.it/350x350');
            $image->setOrdre(1);


            //affectation

            $prestataire->setSuccessAttempt($data->numberBetween(1, 3));
            $prestataire->setAddressNumber($data->numberBetween(1, 1000));
            $prestataire->setAddressRue($data->address);
            $prestataire->setEmail($data->email);
            $prestataire->setBanni($data->boolean);
            $prestataire->setInscriptionDate($data->dateTime);
            $prestataire->setInscription($data->boolean);
            $prestataire->setPassword($data->password);
            $prestataire->setCodePostal($this->getReference('cp-' . rand(1, 10)));
            $prestataire->setLocalite($this->getReference('localite-' . rand(1, 10)));
            $prestataire->setCommune($this->getReference('commune-' . rand(1, 10)));
            $prestataire->setName($data->name);
            $prestataire->setTelnumber($data->phoneNumber);
            $prestataire->setTvanumber($data->numberBetween(20,21));
            $prestataire->setWebsite($data->url);
            $prestataire->setSlug($data->slug);
            $image->setImage('http://placehold.it/350x400');
            $prestataire->setLogo($image);

            $stage->setDescription($data->text);

            $manager->persist($prestataire);

            $this->addReference('prestataire' . $i, $prestataire);
            $this->setReference('stage' . $i, $stage);

        }

        $manager->flush();
    }
/*
    public function getDependencies()
    {
        return [LoadService::class];
    } */
}
