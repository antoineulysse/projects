<?php

namespace App\Transformer;

use App\DTO\AdresseDTO;
use App\Entity\Adresse;

class AdresseTransformer {

    public static function transformeToDTO(Adresse $adresse){
        if($adresse == null) {
            return null;
        }
        $adDTO = new AdresseDTO($adresse->getNumeroRue(),
                                $adresse->getNomRue(),
                                $adresse->getCodePostal(),
                                $adresse->getVille(),
                                $daresse->getPays());

        return $adDTO;
    }

    public static function transformeToEntity(AdresseDTO $adresseDTO){
        if($adresseDTO == null) {
            return null;
        }
        $adresse = new InformationContact($adresse->getNumeroRue(),
                                           $adresse->getTelephone(),
                                           $adresse->getFax());

        return $informationContact;
    }
}