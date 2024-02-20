<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->paginateTrick(1,10);

        return $this->render('base.html.twig', [
            'tricks' => $tricks]);
    }
}
