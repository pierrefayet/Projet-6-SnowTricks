<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginPasswordController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function loginUser(): Response
    {
        return $this->render('login.html.twig');
    }
}