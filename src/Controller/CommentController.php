<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/delete/{id}', name: 'delete_comment', methods: 'POST')]
    public function deleteComment(Comment $comment, EntityManagerInterface $entityManager, Trick $trick): Response
    {
        $entityManager->remove($comment);
        $entityManager->flush();

        return $this->redirectToRoute('single_trick', ['slug' => $trick->getSlug()]);
    }

    #[Route('/get-comments/{trick}', name: 'load_more_comment', methods: 'GET')]
    public function loadMore(CommentRepository $commentRepository, Request $request, Trick $trick): Response
    {
        $page     = $request->query->getInt('page', 2);
        $comments = $commentRepository->paginateTrick($page, 5, $trick);

        return $this->render('comment/comments.html.twig', [
            'comments' => $comments,
        ]);
    }
}
