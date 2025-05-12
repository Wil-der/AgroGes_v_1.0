<?php

namespace App\Form;

use App\Entity\Especialidad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EspecialidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'required'=> true,
                'label' => 'Nombre',
                'constraints' => [
                new NotBlank(['message' => 'Este campo es obligatorio']),
            ],
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada',
                'placeholder' => 'Nombre de la especialidad',
            ],
                'label_attr' => ['class' => 'etiqueta'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Especialidad::class,
        ]);
    }
}
