<?php

namespace App\Form;

use App\Entity\Especialidad;
use App\Entity\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType as TypeFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
            'data_class' => File::class,
        ]);
    }
}
