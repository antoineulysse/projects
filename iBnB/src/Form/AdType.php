<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends ApplicationType
{
 
    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                 TextType::class, 
                 $this->getConfiguration("Titre", "Tapez un super titre pour votre annonce")
                 )
            ->add(
                'slug',
                 TextType::class, 
                 $this->getConfiguration("Chaine Url", "Adresse Web (automatique)",[
                     'required'=>false
                 ])
                 )
            ->add(
                'coverImage',
                 UrlType::class, 
                 $this->getConfiguration("URL de l'image", "Donnez l'adresse d'une image qui donne envie")
                 )
            ->add(
                'introduction',
                 TextType::class, 
                 $this->getConfiguration("Introduction", "Donnez une description globale de votre logement")
                 )
            ->add(
                'content',
                TextareaType::class, 
                $this->getConfiguration("description détaillée", "Tapez une description qui donne envie d'aller chez vous!")
                )
            ->add(
                'rooms', 
                IntegerType::class, 
                $this->getConfiguration("Nombre de chambres", "le nombre de chambres disponibles")
                )
            ->add(
                'price', 
                MoneyType::class, 
                $this->getConfiguration("Prix par nuit", "Indiquez leprix que vous voulez pour une nuit")
                )
            ->add(
                'images', 
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
