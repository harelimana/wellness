<?php

namespace App\DataFixtures;

use App\Entity\CodePostal;
use App\Entity\Commune;
use App\Entity\Internaute;
use App\Entity\Localite;
use App\Entity\Prestataire;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Test\Provider\Collection;
use Proxies\__CG__\App\Entity\Image;

class LoadUser extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {

        $data= Factory::create("fr_BE");
/*
        $codeposts = $manager->getRepository(CodePostal::class)->findAll();
        $service = $manager->getRepository(Service::class)->findAll();
        $communes = $manager->getRepository(Commune::class)->findAll();
        $localites = $manager->getRepository(Localite::class)->findAll();

        for($i=0; $i<10; $i++){
            $prestataire = new Prestataire();
            $cps = new Collection($manager->getRepository('App:CodePostal')->findAll());
            $localite = new Localite();
            $codePost = new CodePostal();
            $commune = new Commune();
            $imago = new Image();
            $logo = new Image();

            $prestataire->setName($data->name);
            $prestataire->setWebsite($data->url);
            $prestataire->setTvanumber($data->text);
            $prestataire->setEmail($data->email);
            $prestataire->setPassword($data->password);
            $prestataire->setAddressNumber($data->numberBetween(0, 100));
            $prestataire->setAddressRue($data->streetName);
            $prestataire->setInscription($data->boolean);
            $prestataire->setSuccessAttempt(3);
            $prestataire->setImage($imago->setImage($data->imageUrl()));
            $prestataire->setLogo($logo->setImage($data->imageUrl()));
            $prestataire->setBanni(0);
            $prestataire->setInscription($data->boolean(false));
            $prestataire->setCodePostal($codePost);
            $prestataire->setLocalite($localite);
            $prestataire->setCommune($commune);
            $prestataire->addService($serice->setService($data->text));

            $manager->persist($prestataire);
        }

        for($i=0; $i<10; $i++){
            $internaute = new Internaute();

            $localite = new Localite();
            $codePost = new CodePostal();
            $commune = new Commune();

            $internaute->setFirstname($data->name);
            $internaute->setLastname($data->firstName);
            $internaute->setEmail($data->email);
            $internaute->setPassword($data->password);
            $internaute->setAddressNumber($data->numberBetween(0, 100));
            $internaute->setAddressRue($data->streetName);
            $internaute->setInscription($data->boolean);
            $internaute->setSuccessAttempt(3);

            $internaute->setBanni(0);
            $internaute->setInscription($data->boolean(false));
            $internaute->setCodePostal($this->getReference("cp", $codePost));
            $internaute->setLocalite($this->getReference("localite", $localite));
            $internaute->setCommune($this->getReference("commune", $commune));

            $manager->persist($internaute);
        }

        $manager->flush(); */
    }
}
