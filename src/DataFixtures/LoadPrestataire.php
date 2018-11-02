<?php

namespace App\DataFixtures;

use App\Entity\CodePostal;
use App\Entity\Commune;
use App\Entity\Image;
use App\Entity\Localite;
use App\Entity\Prestataire;
use App\Entity\Service;
use App\Entity\Stage;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadPrestataire extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data = Factory::create();


        for ($i = 0; $i < 10; $i++) {
            $image = new Image();
            $service = new Service();
            $prestataire = new Prestataire();
            $stage = new Stage;

            $localite = new Localite();
            $codePost = new CodePostal();
            $commune = new Commune();

            $image->setImage($data->text());
            $image->setOrdre(rand(1,5));

            $prestataire->setSuccessAttempt($data->numberBetween(1,3));
            $prestataire->setAddressNumber($data->numberBetween(1,1000));
            $prestataire->setAddressRue($data->address);
            $prestataire->setEmail($data->email);
            $prestataire->setBanni($data->boolean);
            $prestataire->setInscriptionDate($data->dateTime);
            $prestataire->setInscription($data->boolean);
            $prestataire->setPassword($data->password);

            $localite->setLocalite($data->Text);
            $codePost->setCodepostal($data->numberBetween(1,10000));
            $commune->setCommune($data->Text);

            $prestataire->setName($data->name);
            $prestataire->setTelnumber($data->text);
            $prestataire->setTvanumber($data->text);
            $prestataire->setWebsite($data->text);
            $prestataire->setImage($data->image = null);

            $stage->setDescription($data->text);


            $manager->persist($localite);
            $manager->persist($codePost);
            $manager->persist($commune);

            $manager->persist($image);
            $manager->persist($service);
            $manager->persist($prestataire);
            $manager->persist($stage);


            $this->setReference("service" . $i, $service);
            $this->setReference("image" . $i, $image);
            $this->addReference("prestataire" . $i, $prestataire);
            $this->setReference("stage" . $i, $stage);

        }

        $manager->flush();
    }
}
