<?php

namespace App\Form;

use App\Entity\CentroUEB;
use App\Entity\UEB;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CentroUEBType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('cantTrabajDirecto')
            ->add('cantTrabajIndirecto')
            ->add('totalTrabaj')
            ->add('uEB', EntityType::class, [
                'class' => UEB::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CentroUEB::class,
        ]);
    }
}
