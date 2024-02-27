<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ForgotFormType extends UserFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userName', TextType::class, [
                'attr'   => ['id' => 'Username'],
                'mapped' => false,
            ])
            ->add('email', EmailType::class, [
                'attr'   => ['id' => 'email'],
                'mapped' => false,
            ]);
    }
}
