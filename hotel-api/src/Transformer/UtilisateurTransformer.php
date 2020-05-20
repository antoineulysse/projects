<?php

namespace App\Transformer;

use App\DTO\UtilisateurDTO;
use App\Entity\Utilisateur;

class UtilisateurTransformer {

    /**
     * Transformes a Personne Object to PersonneDTO object
     *
     * @param Utilisateur $utilisateur
     * @return UtilisateurDTO
     */
    public static function transformeUtilisateurToUtilisateurDTO(Utilisateur $utilisateur){
        if($utilisateur == null){
            return null;
        }
        $utilisateurDTO = new UtilisateurDTO($utilisateur->getPrenom(),
                                             $utilisateur->getNom(),
                                             $utilisateur->getEmail(),
                                             $utilisateur->getPassword());
        return $utilisateurDTO;
    }

    public static function transformeToListOfDTOS(array $utilisateurs){
        $utilisateursDTos = [];
        foreach ($utilisateurs as $u) {
            $utilisateursDTos[] = self::transformeUtilisateurToUtilisateurDTO($u);
        }
        return $utilisateursDTos;
    }

    public static function transformeToPersonneEntity(UtilisateurDTO $utilisateurDTO){
        if($utilisateurDTO == null){
            return null;
        }
        $utilisateur = (new Utilisateur) -> setPrenom($utilisateurDTO->getPrenom())
                                         -> setNom($utilisateurDTO->getNom())
                                         -> setEmail($utilisateurDTO->getEmail())
                                         -> setPassword($utilisateurDTO->getPassword());
        return $utilisateur;
    }

    public static function updateNewPersonneEntityByNewDTO(Utilisateur $old, UtilisateurDTO $new){
        $old->setPrenom($new->getPrenom())
            ->setNom($new->getNom())
            ->setEmail($new->getEmail())
            ->setPassword($new->getPassword()) ;

        return $old;
    }
}