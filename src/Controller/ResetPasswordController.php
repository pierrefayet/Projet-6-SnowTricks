<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordController extends AbstractController
{
    #[Route('/reset_password', name: 'reset_password')]
    public function resetPassword(): Response
    {
        return $this->render('resetPassword.html.twig');
    }
}
