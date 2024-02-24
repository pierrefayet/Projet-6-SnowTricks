<?php

namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;
use App\Form\UserFormType;
class LoginFormType extends UserFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userName', null, ['attr' => ['id' => 'Username']
            ])
            ->add('password', null, ['attr' => ['id' => 'passsword']
            ]);
    }
}
