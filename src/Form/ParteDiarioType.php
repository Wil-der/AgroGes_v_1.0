<?php

namespace App\Form;

use App\Entity\ParteDiario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParteDiarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Campos de la entidad ParteDiario
        $builder->add('fecha', null, [
            'widget' => 'single_text',
            'row_attr' => ['class' => 'campo-fecha'],
            'attr' => [
                'class' => 'form-control custom-input entrada ',
                'placeholder' => 'Selecciona la fecha'
            ],
            'label'=> false
        ]);
        // Formularios anidados
        $builder->add('hechosExtraordinarios', HechosExtraordinariosType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('produccionHuevos', ProduccionHuevosType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('pienso', PiensoType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('campana1', Campana1Type::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('campana2', Campana2Type::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('peces', PecesType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('combustible', CombustibleType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('nacimientos', NacimientosType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('mortalidad', MortalidadType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('maquinaIngeniera', MaquinaIngenieraType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('equipoRiego', EquipoRiegoType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('transportacion', TransportacionType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('contenedores', ContenedoresType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        
        $builder->add('extraccionCombustible', ExtraccionCombustibleType::class, [
            'attr' => ['class' => 'form-group custom-form'],
            'row_attr' => ['class' => 'container-campo'],
            'label_attr' => ['class' => 'etiqueta-primary'],
        ]);
        

       
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ParteDiario::class,
        ]);
    
    }
}
