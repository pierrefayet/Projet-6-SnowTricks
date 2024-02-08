<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->findAll();

        return $this->render('base.html.twig', ['tricks' => $tricks]);
    }
}
