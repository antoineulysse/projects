<?php


namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\CaracteristiqueHotel;
use App\Entity\Chambre;
use App\Entity\Hotel;
use App\Entity\Prix;
use App\Entity\TypeChambre;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $hotels;
    private $adresses;
    private $utilisateurs;
    private $chambres;
    private $typeChambres;

    public function load(ObjectManager $manager)
    {
        
        for($d = 0; $d<5;$d++){
            $adresse= new Adresse();
            $adresse ->setNumeroRue(mt_rand(1,200))
                    ->setNomRue("Rue du")
                    ->setCodePostal(mt_rand(10000, 99000))
                    ->setVille("Ville-")
                    ->setPays("Pays-");
            $manager->persist($adresse);
            $adresses[]=$adresse;

        }   
       
        for($e=0; $e<5;$e++){
            $hotel = new Hotel();
            $hotel ->setNomHotel('hotel')
                    ->setNombreEtoile(mt_rand(0, 5))
                    ->setNumeroTelephone('08366565')
                    ->setAdresse($adresses[$e]);
            $manager->persist($hotel);        
            $hotels[]=$hotel;
            $caracteristiqueHotel= (new CaracteristiqueHotel())
                    ->setHotel($hotel)
                    ->setPetitDejeuner(true)
                    ->setParking(true)
                    ->setRestaurant(true)
                    ->setBar(true)
                    ->setClimatiseur(true);
            $manager->persist($caracteristiqueHotel);
            for($f=0; $f<5; $f++){
                $chambre = new Chambre();
                $chambre ->setTelevision(1)
                         ->setInternet(1)
                         ->setHotel($hotel);               
                $manager->persist($chambre);
                $chambres[]=$chambre;
                for($g=0; $g<2; $g++){
                    $prix= (new Prix())->setTarif(mt_rand(50,100));
                    $manager->persist($prix);
                    for($h=0;$h<1;$h++){
                        $typeChambre = new TypeChambre();
                        $typeChambre->setCapacite(mt_rand(1,5))
                                    ->setType(mt_rand(1,3))
                                    ->setPrix($prix)
                                    ->setChambre($chambre);
                        $manager->persist($typeChambre);  
                        $typeChambres[]=$typeChambre; 
                    }
                    
                    
                }        
    
                                        
            }
            
        } 
                
        

        for($c = 0; $c<5; $c++){
            $utilisateur = new Utilisateur();
            $faker = Factory::create('fr_FR');
            $utilisateur ->setNom($faker->firstName)
                            ->setPrenom($faker->lastname) 
                            ->setEmail($faker->email)
                            ->setPassword($faker->password);
            $manager->persist($utilisateur);    
        }            
    

        $manager->flush();
    }
}
