<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickFormType;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

        return $this->render('singleTrick.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/update_tricks/{id}', name: 'update_tricks')]
    public function modifyArticle(Request $request, EntityManagerInterface $entityManager, TrickRepository $trickRepository, Trick $id): Response
    {
        $trick = $trickRepository->find($id);

        if (!$trick) {
            throw new NotFoundHttpException('No trick found for id: ' . $trick->getId());
        }
        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('single_trick', ['id' => $trick->getId()]);
        }

        return $this->render('updateTrick.html.twig');
    }

    #[Route('/single_trick/{id}', name: 'single_trick')]
    public function showTrick(Trick $trick): Response
    {

        return $this->render('singleTrick.html.twig', ['trick' => $trick]);
    }

    #[Route('/delete_trick/{id}', name: 'delete_trick')]
    public function deleteTrick(int $id, EntityManagerInterface $entityManager, TrickRepository $trickRepository): Response
    {

        $trick = $trickRepository->find($id);

        if (!$trick) {
            throw new NotFoundHttpException('No trick found for id: ' . $trick->getId());
        }

        $entityManager->remove($trick);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }
}
