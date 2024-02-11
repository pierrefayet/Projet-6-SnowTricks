<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Trick;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content', TextareaType::class)
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false
            ])
            ->add('newTags', null, [
                'mapped' => false,
                'required' => false,
                'attr' => ['placeholder' => 'Saisir un nouveau tag']
            ])
            ->add('save', SubmitType::class, ['label' => 'Save'])
            ->add('delete', SubmitType::class, ['label' => 'Delete'])
            ->add('medias', CollectionType::class, [
                'entry_type' => MediaType::class,
                'allow_add' => true,
                'by_reference' => false,
                'mapped' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class
        ]);
    }
}
