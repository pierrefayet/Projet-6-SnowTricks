<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class HomePageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->findAll();
    return $this->render('base.html.twig', ['trick' => $tricks]);
    }
}
