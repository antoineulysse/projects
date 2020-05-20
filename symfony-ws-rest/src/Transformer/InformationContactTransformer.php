<?php

namespace App\Transformer;

use App\DTO\InformationContactDTO;
use App\Entity\InformationContact;

class InformationContactTransformer {

    public static function transformeToDTO(InformationContact $informationContact){
        if($informationContact == null) {
            return null;
        }
        $iCDTO = new InformationContactDTO($informationContact->getEmail(),
                                           $informationContact->getTelephone(),
                                           $informationContact->getFax());

        return $iCDTO;
    }

    public static function transformeToEntity(InformationContactDTO $informationContactDTO){
        if($informationContactDTO == null) {
            return null;
        }
        $informationContact = new InformationContact($informationContactDTO->getEmail(),
                                           $informationContactDTO->getTelephone(),
                                           $informationContactDTO->getFax());

        return $informationContact;
    }
}