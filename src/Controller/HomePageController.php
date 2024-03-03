<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home', methods: 'GET')]
    public function home(TrickRepository $trickRepository): Response
    {
        $page    = 1;
        $tricks  = $trickRepository->paginateTrick($page, 10);
        $maxPage = ceil($tricks->getTotalItemCount() / 10);

        return $this->render('base.html.twig', [
            'tricks'  => $tricks,
            'maxPage' => $maxPage,
        ]);
    }

    #[Route('/get-tricks', name: 'load_more')]
    public function loadMore(TrickRepository $trickRepository, Request $request): Response
    {
        $page   = $request->query->getInt('page', 2);
        $tricks = $trickRepository->paginateTrick($page, 10);

        return $this->render('trick/tricks.html.twig', [
            'tricks' => $tricks,
        ]);
    }
}
