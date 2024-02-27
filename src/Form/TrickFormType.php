<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Category;
use App\Entity\Trick;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**TODO: ajouter les champs pour creer un tricks avec tous les champs et utiliser le meme form que update mais avoir une seconde vue
*   ajouter un champs pour les images et les vidéos
 */
class TrickFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, ['label' => false])
            ->add('intro', null, ['label' => false])
            ->add('content', TextareaType::class, ['label' => false])
            ->add('category', EntityType::class, [
                'class'        => Category::class,
                'choice_label' => 'name',
            ])
            ->add('medias', CollectionType::class, [
                'entry_type'        => FileType::class,
                'entry_options'     => ['label' => false],
                'allow_add'         => true,
                'allow_delete'      => true,
                'by_reference'      => false,
                'mapped'            => false,
                'label_attr'        => ['style' => 'display: none'],
                'prototype_options' => [
                    'label' => false,
                ],
            ])
            ->add('externalVideo', CollectionType::class, [
                'entry_type'        => ExternalVideoType::class,
                'entry_options'     => ['label' => false],
                'allow_add'         => true,
                'allow_delete'      => true,
                'by_reference'      => false,
                'label_attr'        => ['style' => 'display: none'],
                'prototype_options' => [
                    'label' => false,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
