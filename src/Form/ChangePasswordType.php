<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use App\Entity\User;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Usuario',
                'disabled' => true,
                'attr' => ['class' => 'entrada'],
                'row_attr' => ['class' => 'campo'],
                'label_attr' => ['class' => 'etiqueta'],
            ])
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Contraseña actual',
                'mapped' => false,
                'attr' => ['autocomplete' => 'current-password', 'class' => 'entrada'],
                'row_attr' => ['class' => 'campo'],
                'label_attr' => ['class' => 'etiqueta'],
                'constraints' => [
                    new NotBlank(['message' => 'Debe introducir su contraseña actual.']),
                ],
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options'  => [
                    'label' => 'Nueva contraseña',
                    'attr' => ['class' => 'entrada'],
                    'row_attr' => ['class' => 'campo'],
                    'label_attr' => ['class' => 'etiqueta'],
                ],
                'second_options' => [
                    'label' => 'Repetir contraseña',
                    'attr' => ['class' => 'entrada'],
                    'row_attr' => ['class' => 'campo'],
                    'label_attr' => ['class' => 'etiqueta'],
                ],
                'invalid_message' => 'Las contraseñas no coinciden.',
                'constraints' => [
                    new NotBlank(['message' => 'Debe introducir una nueva contraseña.']),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'La contraseña debe tener al menos {{ limit }} caracteres.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
