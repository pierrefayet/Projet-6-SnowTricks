<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/add_comment', name: 'add_comment')]
    public function AddComment():Response
    {
        $comment = new Comment;

        return $this->render('singleTrick.html.twig', []);
    }

    #[Route('/delete_comment/{id}', name: 'delete_comment')]
    public function deleteTrick(): Response
    {

        return $this->render('singleTrick.html.twig', []);
    }
}
