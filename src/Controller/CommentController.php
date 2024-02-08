<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommentController extends AbstractController
{
    #[Route('/add_comment/{id}', name: 'add_comment')]
    public function AddComment(Request $request, EntityManagerInterface $entityManager, Trick $trick): Response
    {
        $comment = new Comment();
        $form    = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCommentPostId($trick);
            $comment->setCommentUserId($this->getUser());
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('single_trick', ['id' => $trick->getId()]);
        }

        return $this->render('singleTrick.html.twig', [
            'comment' => $form->createView(),
        ]);
    }

    #[Route('/delete_comment/{id}', name: 'delete_comment')]
    public function deleteComment(Comment $comment, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($comment);
        $entityManager->flush();

        return $this->redirectToRoute('single_trick');
    }
}
