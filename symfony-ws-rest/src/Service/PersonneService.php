<?php

namespace App\Service;

use App\DTO\PersonneDTO;
use App\Repository\PersonneRepository;
use App\Transformer\PersonneTranformer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Exception;

class PersonneService {

    private $personneRepository;
    private $personneEntityManager;

    public function __construct(EntityManagerInterface $manager, PersonneRepository $personneRepository)
    {
        $this->personneRepository = $personneRepository;
        $this->personneEntityManager = $manager;
    }

    public function findAllPersonnes(){
        $personnes = $this->personneRepository->findAll();
        $personneDTOs = PersonneTranformer::transformeToListOfDTOS($personnes);
        return $personneDTOs;
    }

    public function addNewPersonne(PersonneDTO $personneDTO){
        if($personneDTO == null){
            throw new Exception("Contenu de la requête Post est vide.");
        }
        $personne = PersonneTranformer::transformeToPersonneEntity($personneDTO);
        if ($personne != null) {
            $this->personneEntityManager->persist($personne);
            $this->personneEntityManager->flush();
        }
    }

    public function updatePersonne(int $id, PersonneDTO $personneDTONew){
        $personneOld = $this->personneRepository->find($id);
        if($personneOld == null){
            throw new Exception("Personne avec l'id $id non trouvée. Pas possible de la mettre à jour");
        }
        $personneNew = PersonneTranformer::updateNewPersonneEntityByNewDTO($personneOld, $personneDTONew);
        
        try {
            $this->personneEntityManager->persist($personneNew);
            $this->personneEntityManager->flush();
        } catch (QueryException $e){
            throw $e;
        }

    }
}