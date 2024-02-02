<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Form\TrickFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TricksController extends AbstractController
{
    #[Route('/add_trick', name: 'add_trick')]
    public function addTrick(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trick = new Trick();
        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trick);
            $entityManager->flush();

            return $this->redirectToRoute('single_trick', ['id' => $trick->getId()]);
        }

        return $this->render('singleTrick.html.twig', [
            'formTrick' => $form->createView()
        ]);
    }

    #[IsGranted('edit', 'trick')]
    #[Route('/update_tricks/{id}', name: 'update_tricks')]
    public function modifyArticle(Request $request, EntityManagerInterface $entityManager, Trick $trick): Response
    {

        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('single_trick', [
                'id' => $trick->getId()
            ]);
        }

        return $this->render('updateTrick.html.twig', [
            'formTrick' => $form->createView(),
            'trick' => $trick
        ]);
    }

    #[Route('/single_trick/{id}', name: 'single_trick')]
    public function showTrick(Trick $trick, CommentController $commentForm): Response
    {
        $comment = new Comment();
        $commentForm = $commentForm->createForm(CommentFormType::class, $comment);

        return $this->render('singleTrick.html.twig', [
            'trick' => $trick,
            'comment' => $commentForm->createView()
        ]);
    }
    #[IsGranted('delete', 'trick')]
    #[Route('/delete_trick/{id}', name: 'delete_trick')]
    public function deleteTrick(Trick $trick, EntityManagerInterface $entityManager): Response
    {

        $entityManager->remove($trick);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }
}
