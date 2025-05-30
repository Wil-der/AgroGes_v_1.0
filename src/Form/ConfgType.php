<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfgType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['secciones'] as $seccionKey => $seccionLabel) {
            // Agregamos un formulario anidado para cada sección (clave limpia)
            $builder->add($seccionKey, FormType::class, ['mapped' => false]);

            // Añadimos checkboxes para empresas
            foreach ($options['empresas'] as $empresa) {
                $id = 'empresa_' . $empresa['id'];
                $builder->get($seccionKey)->add($id, CheckboxType::class, [
                    'required' => false,
                    'label' => false,
                    'data' => in_array($id, $options['asociaciones'][$seccionKey] ?? []),
                    'row_attr' => ['class' => 'campo'],
                    'attr' => ['class' => 'entrada'],
                    'label_attr' => ['class' => 'etiqueta'],
                ]);
            }

            // Añadimos checkboxes para centros
            foreach ($options['centros'] as $centro) {
                $id = 'centro_' . $centro['id'];
                $builder->get($seccionKey)->add($id, CheckboxType::class, [
                    'required' => false,
                    'label' => false,
                    'data' => in_array($id, $options['asociaciones'][$seccionKey] ?? []),
                    'row_attr' => ['class' => 'campo'],
                    'attr' => ['class' => 'entrada'],
                    'label_attr' => ['class' => 'etiqueta'],
                ]);
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'secciones' => [],      // array asociativo: ['campana1' => 'Campaña 1', ...]
            'empresas' => [],
            'centros' => [],
            'asociaciones' => [],
        ]);
    }
}
