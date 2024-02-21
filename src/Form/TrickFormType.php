<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, ['label' => false])
            ->add('intro', null, ['label' => false])
            ->add('content', TextareaType::class, ['label' => false])
            ->add('addTags', CollectionType::class, [
                'entry_type' => TextType::class,
                'entry_options' => ['label' => false],
                'mapped' => false,
                'required' => false,
                'attr' => ['placeholder' => 'Saisir un nouveau tag']
            ])
            ->add('medias', CollectionType::class, [
                'entry_type' => FileType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'mapped' => false,
                'label_attr' => ['style' => 'display: none'],
                'prototype_options' => [
                    'label' => false
                ],
            ])
            ->add('newTags', CollectionType::class, [
                'entry_type' => TextType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'mapped' => false,
                'label_attr' => ['style' => 'display: none'],
                'prototype_options' => [
                    'label' => false
                ],
            ])
            ->add('save', SubmitType::class, ['label' => 'Save']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class
        ]);
    }
}
