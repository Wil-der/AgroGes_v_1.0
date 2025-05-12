<?php

namespace App\Form;

use App\Entity\Empresa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('mision', TextareaType::class, [
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('cantTrabajDirecto', null, [
                'label' => 'Cantidad de Trabajadores Directos',
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('cantTrabajIndirecto',null, [
                'label' => 'Cantidad de Trabajadores Indirectos',
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('name',null,[
                'label' => 'Nombre',
                'required' => true,
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada',
                'placeholder' => 'Nombre del archivo',
            ],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('fileUpload', TypeFileType::class, [
                'mapped' => false,
                'required' => true,
                'label' => 'Archivo',
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Empresa::class,
        ]);
    }
}
