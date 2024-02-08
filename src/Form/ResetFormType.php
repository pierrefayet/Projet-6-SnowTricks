<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;

class ResetFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email');
    }
}
