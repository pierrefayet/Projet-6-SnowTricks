<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Usertype;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LoginPasswordController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function loginUser(Request $request): Response
    {
        $user = new User();
        $userConnectionForm = $this->createForm(Usertype::class, $user);
        $userConnectionForm->handleRequest($request);
        if ($userConnectionForm->isSubmitted() && $userConnectionForm->isValid()) {
            $formData = $userConnectionForm->getData();
            $existingUser = $this->getDoctrine()->getRepository(User::class)->findOneBy(['userName' => $formData->getUserName()]);
            if ($existingUser && $passwordEncoder->isPasswordValid($existingUser, $formData->getPassword())) {
                return $this->redirectToRoute('/');
            } else {
                $this->addFlash('error', 'Invalid username or password.');
            }
        }

        return $this->render('login.html.twig', ['connection' => $userConnectionForm->createView()]);
    }

}