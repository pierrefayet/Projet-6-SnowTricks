<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// todo: Récupérer les données et les insérer en baseet initier le CRUD
class TricksController extends AbstractController
{
    #[Route('/add_Trick', name: 'add_trick')]
    public function addTrick(): Response
    {

        $trick = new Trick();
        return $this->render('singleTrick.html.twig', []);
    }

    #[Route('/update_tricks', name: 'update_tricks')]
    public function modifyArticle(): Response
    {

        return $this->render('updateTrick.html.twig');
    }

    #[Route('/single_trick/{id}', name: 'single_trick')]
    public function showTrick(int $id, TrickRepository $trickRepository): Response
    {
        $trick = $trickRepository->find($id);

        if(!$trick) {
            throw new $this->createNotFoundException('No trick found for id: ' . $id);
        }


        return $this->render('singleTrick.html.twig', ['trick' => $trick]);
    }

    #[Route('/delete_trick/{id}', name: 'delete_trick')]
    public function deleteTrick(int $id, EntityManagerInterface $entityManager, TrickRepository $trickRepository): Response
    {

        $trick = $trickRepository->find($id);

        if(!$trick) {
            throw new $this->createNotFoundException('No trick found for id: ' . $id);
        }

        $entityManager->remove($trick);
        $entityManager->flush();

        return $this->redirectToRoute('single_trick');
    }
}
