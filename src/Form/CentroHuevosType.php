<?php

namespace App\Form;

use App\Entity\Centro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CentroHuevosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plan', null, [
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('existenciaDiaria', null, [
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('existenciaAcumulada', null, [
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('existenciaAlmacen', null, [
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Centro::class,
        ]);
    }
}
