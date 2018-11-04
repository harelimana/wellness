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

class CPFixtures extends fixture
{
    public const CP_REF = 'cp-ref';

    public function load(ObjectManager $manager)
    {
        $cps = array(); //array() of postal-codes

        //  $data = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $cp = new CodePostal();
            $cp = rand(1000, 9000);
            $cps[] = $cp; //array() of postal-codes
            $manager->persist($cp);
        }

        $this->addReference(self::CP_REF, $cps);
        $manager->flush();
    }

}

class LOCFixtures extends fixture
{
    public const LOC_REF = 'loc-ref';

    public function load(ObjectManager $manager)
    {
        $locs = array(); //array() of locations

        //  $data = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $loc = new Localite();
            $loc = "Namur" . $i;
            $locs[] = $loc;
            $manager->persist($loc);
        }

        $this->addReference(self::LOC_REF, $locs);
        $manager->flush();
    }

}

class COMMFixtures extends fixture
{
    public const COMM_REF = 'comm-ref';

    public function load(ObjectManager $manager)
    {
        $comms = array(); //array() of communes

        //  $data = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $comm = new Commune();
            $comm = "Gemeentehuis" . $i;
            $comms[] = $comm;
            $manager->persist($comm);
        }

        $this->addReference(self::COMM_REF, $comms);
        $manager->flush();
    }

}

class LoadPrestataire extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data = Factory::create();

        $cpref = $this->getReference(CPFixtures::CP_REF);
        $locref = $this->getReference(LOCFixtures::LOC_REF);
        $comref = $this->getReference(COMMFixtures::COMM_REF);

        $image = new Image();
        $service = new Service();
        $prestataire = new Prestataire();
        $stage = new Stage;

        $localite = new Localite();
        $codePost = new CodePostal();
        $commune = new Commune();

        $image->setImage($data->text());
        $image->setOrdre(rand(1, 5));

        $prestataire->setSuccessAttempt($data->numberBetween(1, 3));
        $prestataire->setAddressNumber($data->numberBetween(1, 1000));
        $prestataire->setAddressRue($data->address);
        $prestataire->setEmail($data->email);
        $prestataire->setBanni($data->boolean);
        $prestataire->setInscriptionDate($data->dateTime);
        $prestataire->setInscription($data->boolean);
        $prestataire->setPassword($data->password);

        $localite->setLocalite(array_rand($locref, 1));
        $codePost->setCodePostal(array_rand($cpref, 1));
        $commune->setCommune(array_rand($comref, 1));

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

    public function getDependencies()
    {
        return array(
            CPFixtures::class, LOCFixtures::class, COMMFixtures::class
        );
    }


}
