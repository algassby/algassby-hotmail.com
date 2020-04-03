<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Config\Definition\IntegerNode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    /**
     * permet de configurer un champ
     * @param String $label
     * @param String  $placeholder
     * @return array
     *
     */
    public function  getConfiguration($label, $placeholder){
        return [
            'label'=> $label,
            'attr'=>[
                'placeholder'=> $placeholder

            ]
        ];
    }

    /**
     * creer un formulaire
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Tire", "Tapez un super titre pour votre annonce"))
            ->add('slug', TextType::class,$this->getConfiguration("Adresse web", "Tapez une url"))
            ->add('coverImage', UrlType::class,$this->getConfiguration("URL de l'image principale", "donner une image qui donne vraiment envie"))
            ->add('introduction',TextType::class,$this->getConfiguration("Introduction", "Donnez une description globale de votre annonce"))
            ->add('content', TextareaType::class, $this->getConfiguration("Description detaillée","Donner une description qui donne envie de venir chez vous"))
            ->add('rooms', IntegerType::class,$this->getConfiguration("Nombre de chambres","le nombre de chambres disponibles"))
            ->add('price',MoneyType::class, $this->getConfiguration("Prix par nuit","indiquez le prix que vous voulez pour une nuit"))
            ->add('yes',
                CollectionType::class,[
                    'entry_type'=>ImageType::class,
                    'allow_add'=>true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
