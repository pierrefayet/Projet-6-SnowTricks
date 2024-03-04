<?php

declare(strict_types=1);

namespace App\Services\Manager;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use App\Form\CommentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CommentManager
{
    public function __construct(
        private readonly RequestStack $request,
        private readonly FormFactoryInterface $formFactory,
        private readonly Security $security,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function addComment(Trick $trick): FormInterface
    {
        $comment = new Comment();
        $form    = $this->formFactory->create(CommentFormType::class, $comment);
        $form->handleRequest($this->request->getCurrentRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setTrick($trick);

            $user = $this->security->getUser();
            if ($user instanceof User) {
                $comment->setCommentUserId($user);
            }

            $this->entityManager->persist($comment);
            $this->entityManager->flush();
        }

        return $form;
    }
}
