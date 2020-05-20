<?php

namespace App\Transformer;

use App\DTO\PersonneDTO;
use App\Entity\Personne;

class PersonneTranformer {

    /**
     * Transformes a Personne Object to PersonneDTO object
     *
     * @param Personne $personne
     * @return PersonneDTO
     */
    public static function transformePersonneToPersonneDTO(Personne $personne){
        if($personne == null){
            return null;
        }
        $personneDTO = new PersonneDTO($personne->getPrenom(),
                                       $personne->getNom(),
                                       InformationContactTransformer::transformeToDTO($personne->getInformationContact()));
        return $personneDTO;
    }

    public static function transformeToListOfDTOS(array $personnes){
        $personnesDTos = [];
        foreach ($personnes as $p) {
            $personnesDTos[] = self::transformePersonneToPersonneDTO($p);
        }
        return $personnesDTos;
    }

    public static function transformeToPersonneEntity(PersonneDTO $personneDTO){
        if($personneDTO == null){
            return null;
        }
        $personne = (new Personne) -> setPrenom($personneDTO->getPrenom())
                                   -> setNom($personneDTO->getNom())
                                   -> setInformationContact(InformationContactTransformer::transformeToEntity($personneDTO->getInformationContactDTO()));
        return $personne;
    }

    public static function updateNewPersonneEntityByNewDTO(Personne $old, PersonneDTO $new){
        $old->setPrenom($new->getPrenom())
            ->setNom($new->getNom())
            ->setInformationContact(InformationContactTransformer::transformeToEntity($new->getInformationContactDTO()));

        return $old;
    }
}