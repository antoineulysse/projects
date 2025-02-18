<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

class ApplicationType extends AbstractType{
    /**
     * permet d'avori la configuration de base d'un champ !
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    protected function getConfiguration($label, $placeholder, $options = []){
        return array_merge_recursive([
            'label'=> $label,
                'attr'=>[
                    'placeholder'=> $placeholder
                ]
                ], $options);

    }
}