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
            ->add('mision')
            ->add('cantTrabajdirecto')
            ->add('cantTrabajIndirecto')
            ->add('totalTrabaj')
            ->add('name')
            ->add('empresa', EntityType::class, [
                'class' => Empresa::class,
                'choice_label' => 'id',
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
