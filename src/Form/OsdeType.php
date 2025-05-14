<?php

namespace App\Form;

use App\Entity\Osde;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class OsdeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'mision',
                TextareaType::class,
                [
                    'label' => 'Misión',
                    'attr' => [
                        'class' => 'entrada',
                        'placeholder' => 'Misión',
                    ],
                    'label_attr' => ['class' => 'etiqueta'],
                    'row_attr' => ['class' => 'campo'],

                ]
            )
            ->add(
                'vision',
                TextareaType::class,
                [
                    'label' => 'Visión',
                    'attr' => [
                        'class' => 'entrada',
                        'placeholder' => 'Visión',
                    ],
                    'label_attr' => ['class' => 'etiqueta'],
                    'row_attr' => ['class' => 'campo'],
                ]
            )
            ->add('estructuraOrganizativa', FileType::class, [
                'label' => 'Estructura Organizativa',
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
                'row_attr' => ['class' => 'campo'],

            ])
            ->add('guiaTelefonica', FileType::class, [
                'label' => 'Guía Telefónica',
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
                'row_attr' => ['class' => 'campo'],

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Osde::class,
        ]);
    }
}
