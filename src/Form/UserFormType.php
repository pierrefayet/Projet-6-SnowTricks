<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userName', null, ['attr' => ['id' => 'username'],
            ])
            ->add( 'password', null, ['attr' => ['id' => 'password'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'    => User::class,
            'attr'          => ['class' => 'connection-content'],
            'csrf_token_id' => 'authenticate'
        ]);
    }
}
