<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Usertype;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginPasswordController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function loginUser(): Response
    {
        $user = new User();
        $userConnectionForm = $this->createForm(Usertype::class, $user);
        return $this->render('login.html.twig', ['connection' => $userConnectionForm->createView()]);
    }
}