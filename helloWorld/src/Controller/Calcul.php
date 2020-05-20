<?php

namespace App\Controller;

use InvalidArgumentException;

class Calcul{

    public function addition (int $a, int $b){
        return $a + $b;
    }

    public function soustraction (int $a, int $b){
        return $a-$b;
    }

    public function multiplication (int $a, int $b){
        return $a*$b;
    }
    public function division($a,$b){
        if($b == 0)
            throw new InvalidArgumentException('Division by Zero');
        return $a/$b;
    }
}