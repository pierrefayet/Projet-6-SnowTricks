<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingleTrickController extends AbstractController
{
    #[Route('/single_trick', name: 'single_trick')]
    public function showTrick(): Response
    {
        return $this->render('singleTrick.html.twig');
    }
}
