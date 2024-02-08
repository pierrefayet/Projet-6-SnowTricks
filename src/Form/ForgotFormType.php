<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;

class ForgotFormType extends UserFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('userName')
            ->add('email')
            ->remove('password');
    }
}
