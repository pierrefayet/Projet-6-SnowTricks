<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends AbstractController
{
    #[Route('/add_comment/{id}', name: 'add_comment')]
    public function addComment(Request $request, EntityManagerInterface $entityManager,Trick $trick):Response
    {
        $comment = new Comment;
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $comment->setTrick($trick);
            $comment->setCommentUserId($this->getUser());

            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('single_trick', ['slug' => $trick->getSlug()]);
        }

        return $this->render('singleTrick.html.twig', [
            'commentForm' => $form->createView(),
            'addTrick' => $form
        ]);
    }

    #[Route('/delete_comment/{id}', name: 'delete_comment')]
    public function deleteTrick(Comment $comment, EntityManagerInterface $entityManager, Trick $trick): Response
    {

        $entityManager->remove($comment);
        $entityManager->flush();

        return $this->redirectToRoute('single_trick', ['slug' => $trick->getSlug()]);
    }

    #[\Symfony\Component\Routing\Annotation\Route('/get-comments', name: 'load_more_comment')]
    public function loadMore(CommentRepository $commentRepository, Request $request): Response
    {
        $page = $request->query->getInt('page', 2);
        $comments = $commentRepository->paginateTrick($page, 5);

        return $this->render('comments.html.twig', [
            'comments' => $comments
        ]);
    }
}
