<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// todo: Récupérer les données et les insérer en baseet initier le CRUD
class TricksController extends AbstractController
{
    #[Route('/update_tricks', name: 'update_tricks')]
    public function modifyArticle(): Response
    {
        return $this->render('updateTrick.html.twig');
    }

    #[Route('/single_trick', name: 'single_trick')]
    public function showTrick(): Response
    {
        return $this->render('singleTrick.html.twig');
    }
}