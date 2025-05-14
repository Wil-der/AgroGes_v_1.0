<?php

namespace App\Form;

use App\Entity\EstructuraOrganizativa;
use App\Entity\Osde;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType as TypeFileType;


class EstructuraOrganizarivaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fileUpload', TypeFileType::class, [
                'mapped' => false,
                'required' => true,
                'label' => false,
                'row_attr' => ['class' => 'campo'],
                'attr' => ['class' => 'entrada'],
                'label_attr' => ['class' => 'etiqueta'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EstructuraOrganizativa::class,
        ]);
    }
}
