<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pactuel',TextType::class,[
                'attr' => [
                    'class' => 'form-control' // ajoute la classe CSS "form-control"
                    //'id' => 'mon-id', // ajoute l'ID "mon-id"
                    //'name' => 'mon-nom' // ajoute un nom personnalisé "mon-nom"
                ]

            ])
            ->add('pnouveau',TextType::class,[

                'attr' => [
                    'class' => 'form-control' // ajoute la classe CSS "form-control"
                    //'id' => 'mon-id', // ajoute l'ID "mon-id"
                    //'name' => 'mon-nom' // ajoute un nom personnalisé "mon-nom"
                ]
            ])
            ->add('pconfirmer',TextType::class,[

                'attr' => [
                    'class' => 'form-control' // ajoute la classe CSS "form-control"
                    //'id' => 'mon-id', // ajoute l'ID "mon-id"
                    //'name' => 'pconfirmer' // ajoute un nom personnalisé "mon-nom"
                ]
            ])
            ->add('modifier',SubmitType::class,[

                'attr' => [
                    'class' => 'btn btn-primary w-md' // ajoute la classe CSS "form-control"
                    //'id' => 'mon-id', // ajoute l'ID "mon-id"
                    //'name' => 'mon-nom' // ajoute un nom personnalisé "mon-nom"
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
