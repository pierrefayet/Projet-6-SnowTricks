<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgotFormType;
use App\Form\RegistrationFormType;
use App\Form\ResetFormType;
use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// todo: Récupérer les données et les insérer en baseet initier le CRUD

class UserController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function loginUser(Request $request): Response
    {
        $user = new User();
        $userConnectionForm = $this->createForm(UserFormType::class, $user);
        $userConnectionForm->handleRequest($request);
        if ($userConnectionForm->isSubmitted() && $userConnectionForm->isValid()) {
            dump($userConnectionForm);
        }

        return $this->render('login.html.twig', ['connection' => $userConnectionForm->createView()]);
    }

    #[Route('/reset_password', name: 'reset_password')]
    public function resetPassword(Request $request): Response
    {
        $user = new User();
        $userConnectionForm = $this->createForm(ResetFormType::class, $user);
        $userConnectionForm->handleRequest($request);
        if ($userConnectionForm->isSubmitted() && $userConnectionForm->isValid()) {
            dump($userConnectionForm);
        }
        return $this->render('resetPassword.html.twig', ['resetPassword' => $userConnectionForm->createView()]);
    }

    #[Route('/forgot_password', name: 'forgot_password')]
    public function forgotPassword(Request $request): Response
    {
        $user = new User();
        $userConnectionForm = $this->createForm(ForgotFormType::class, $user);
        $userConnectionForm->handleRequest($request);
        if ($userConnectionForm->isSubmitted() && $userConnectionForm->isValid()) {
            dump($userConnectionForm);
        }

        return $this->render('forgotPassword.html.twig', ['forgotPassword' => $userConnectionForm->createView()]);
    }

    #[Route('/create_account', name: 'registration')]
    public function registrationUser(Request $request): Response
    {
        $user = new User();
        $userRegistrationForm = $this->createForm(RegistrationFormType::class, $user);
        $userRegistrationForm->handleRequest($request);
        if ($userRegistrationForm->isSubmitted() && $userRegistrationForm->isValid()) {
            dump($user);
            return $this->redirectToRoute('/');
        }

        return $this->render('registration.html.twig', ['registration' => $userRegistrationForm->createView()]);
    }

}