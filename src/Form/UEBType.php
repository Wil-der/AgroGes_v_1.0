<?php

namespace App\Form;

use App\Entity\Empresa;
use App\Entity\UEB;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UEBType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nombre',
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('mision',null,[
                    'label' => 'Misión',
                    'row_attr' => ['class' => 'campo'],
                    'attr' => ['class' => 'entrada'],
                    'label_attr' => ['class' => 'etiqueta'],

            ])
            ->add('cantTrabajdirecto', null, [
                'label' => 'Trabajadores Directos',
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('cantTrabajIndirecto', null, [
                'label' => 'Trabajadores Indirectos',
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UEB::class,
        ]);
    }
}
