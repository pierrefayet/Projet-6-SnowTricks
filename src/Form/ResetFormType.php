<?php

namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;

class ResetFormType extends UserFormType
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
