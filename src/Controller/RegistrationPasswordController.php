<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationPasswordController extends AbstractController
{
    #[Route('/create_account', name: 'create_account')]
    public function createAccount(): Response
    {
        return $this->render('registrationPassword.html.twig');
    }
}
