<?php

namespace App\DataFixtures;

use App\Entity\Internaute;
use App\Entity\Prestataire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadUser extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $data= Factory::create();
        for($i=0; $i<10; $i++){
            $prestataire = new Prestataire();

            $prestataire->setName($data->name);
            $prestataire->setWebsite($data->url);
            $prestataire->setTvanumber($data->text);
            $prestataire->setEmail($data->email);
            $prestataire->setPassword($data->password);
            $prestataire->setAddressNumber($data->numberBetween(0, 100));
            $prestataire->setAddressRue($data->streetName);
            $prestataire->setInscription($data->boolean);
            $prestataire->setSuccessAttempt(3);
            $prestataire->setImage($this->getReference("image". $i));
            $prestataire->setLogo($this->getReference("logo". $i));
            $prestataire->setBanni(0);
            $prestataire->setInscription($data->boolean(false));
            $prestataire->setCodePostal($this->getReference("cp" . $i));
            $prestataire->setLocalite($this->getReference("localite" . $i));
            $prestataire->setCommune($this->getReference("commune" . $i));
            $prestataire->addService($this->getReference("service" . $i));

            $manager->persist($prestataire);
        }

        for($i=0; $i<10; $i++){
            $internaute = new Internaute();

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
            $internaute->setCodePostal($this->getReference("cp" . $i));
            $internaute->setLocalite($this->getReference("localite" . $i));
            $internaute->setCommune($this->getReference("commune" . $i));

            $manager->persist($internaute);
        }

        $manager->flush();
    }
}
