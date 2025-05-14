<?php

namespace App\Form;

use App\Entity\Empresa;
use App\Entity\Especialidad;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', null, [
                'label' => 'Usuario',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Este campo es obligatorio']),
                ],
                'row_attr' => ['class' => 'campo'],
                'attr' => [
                    'class' => 'entrada',
                    'placeholder' => 'Usuario',
                ],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('password', null, [
                'label' => 'Contraseña',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Este campo es obligatorio']),
                ],
                'row_attr' => [
                    'class' => 'campo',
                ],
                'attr' => [
                    'class' => 'entrada',
                    'placeholder' => 'Contraseña',
                ],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('empresa', EntityType::class, [
                'class' => Empresa::class,
                'choice_label' => 'name', // o la propiedad que quieras mostrar
                'placeholder' => 'Seleccione una empresa',
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('especialidad', EntityType::class, [
                'class' => Especialidad::class,
                'choice_label' => 'name', // o la propiedad que quieras mostrar
                'placeholder' => 'Seleccione una Especialidad',
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('centro_coordinacion', CheckboxType::class, [
                'label' => 'Centro de Coordinación',
                'required' => false,
                'mapped' => false,
                'row_attr' => ['class' => 'campo'],
                'label_attr' => ['class' => 'etiqueta'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
