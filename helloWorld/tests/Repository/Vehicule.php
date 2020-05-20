<?php


class Vehicule{
    public static $roues = 4;

}

class Moto extends Vehicule{
    public static $roues =2;

    function afficher(){
        echo self::$roues;

    }    
    function afficher2(){
        echo static::$roues;
    }

  
    
}
$moto = new moto;
$moto->afficher();
$moto->afficher2();
