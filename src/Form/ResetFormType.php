<?php

namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;

class ResetFormType extends UserFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder
            ->remove('email');
    }
}
