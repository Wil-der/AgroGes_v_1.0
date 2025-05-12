<?php

namespace App\Form;

use App\Entity\EntidadPeces;
use App\Entity\Peces;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntidadPecesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', null, [
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('centros', CentroPecesType::class, [
                'row_attr' => ['class' => 'campo'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EntidadPeces::class,
        ]);
    }
}
