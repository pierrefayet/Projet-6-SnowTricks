<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// TODO: Plutot passer par un EventListener
class DefaultController extends AbstractController
{
    #[Route('/default', name: 'error404')]
    public function notFoundPage(): Response
    {
        return $this->render('error404.html.twig');
    }
}
