<?php

namespace App\DTO;

use Doctrine\ORM\Mapping as ORM;


class InformationContactDTO {

    private $email;
    private $telephone;
    private $fax;

    public function __construct(string $email=null, string $telephone=null, string $fax=null){
        $this->email = $email;
        $this->telephone = $telephone;
        $this->fax = $fax;
    }

    

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telephone
     */ 
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @return  self
     */ 
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of fax
     */ 
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set the value of fax
     *
     * @return  self
     */ 
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }
}