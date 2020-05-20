<?php
namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Person;
use App\Entity\Adresse;


class PersonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 10 persons! Bam!
        for ($i = 1; $i < 10; $i++) {
            $person = new person();
            $person->setPrenom('Prénom '.$i);
            $person->setNom("NOM-$i");
            $person->setSalaire(mt_rand(1000, 10000));
            $adresse = $this->createAdresse($i);
            $manager->persist($adresse);
            $adresse -> addPerson($person);
            $person -> setAdresse($adresse);

            $manager->persist($person);
        }

        $manager->flush();
    }
    private function createAdresse(){
        $adresse = new Adresse();
        $adresse -> setNumeroRue(mt_rand(1,200));
        $adresse -> setNomRue ("Rue du" );
        $adresse -> setCodepostal (mt_rand(10000, 99000));
        $adresse -> setVille("Ville-" );
        $adresse -> setPays ("Pays-");
        return $adresse;

    }

}