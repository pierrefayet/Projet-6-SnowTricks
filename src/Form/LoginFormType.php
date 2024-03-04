<?php

declare(strict_types=1);

namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginFormType extends UserFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userName', TextType::class, [
                'attr'  => ['id' => 'Username'],
                'label' => 'Nom utilisateur',
            ])
            ->add('password', PasswordType::class, [
                'attr'  => ['id' => 'passsword'],
                'label' => 'Mot de passe',
            ]);
    }
}
