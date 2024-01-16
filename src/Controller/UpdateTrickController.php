<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateTrickController extends AbstractController
{
    #[Route('/single_trick', name: 'single_trick')]
    public function modifyArticle(): Response
    {
        return $this->render('updateTrick.html.twig');
    }
}
