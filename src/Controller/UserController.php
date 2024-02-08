<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgotFormType;
use App\Form\RegistrationFormType;
use App\Form\ResetFormType;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/login', name: 'security_login')]
    public function loginUser(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $user               = new User();
        $userConnectionForm = $this->createForm(UserFormType::class, $user);
        $userConnectionForm->handleRequest($request);

        return $this->render('login.html.twig', [
            'connection'   => $userConnectionForm->createView(),
            'error'        => $authenticationUtils->getLastAuthenticationError(),
            'lastUserName' => $authenticationUtils->getLastUsername(),
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route('/logout', name: 'security_logout')]
    public function logOut(): void
    {
        throw new \Exception('This should never be reached');
    }

    #[Route('/reset_password', name: 'reset_password')]
    public function resetPassword(Request $request): Response
    {
        $user               = new User();
        $userConnectionForm = $this->createForm(ResetFormType::class, $user);
        $userConnectionForm->handleRequest($request);
        if ($userConnectionForm->isSubmitted() && $userConnectionForm->isValid()) {
            return $this->redirectToRoute('home');
        }

        return $this->render('resetPassword.html.twig', ['resetPassword' => $userConnectionForm->createView()]);
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/forgot_password', name: 'forgot_password')]
    public function forgotPassword(Request $request, MailerInterface $mailer, UserRepository $userRepository): Response
    {
        // TODO: ajouter une gestion d'email car cela renverra un mail (ok) avec le lien pour le template reset password(ok)
        $user               = new User();
        $userConnectionForm = $this->createForm(ForgotFormType::class, $user);
        $userConnectionForm->handleRequest($request);
        $userProfilePage = $this->generateUrl('reset_password', [
            'token' => $user->getUserIdentifier(),
        ]);
        if ($userConnectionForm->isSubmitted() && $userConnectionForm->isValid()) {
            $userEmail = $userRepository->findOneByEmail($userConnectionForm->get('email')->getData());
            $email     = new Email();
            $email->from('no-relpy@site.fr');
            $email->to($userConnectionForm->getName());
            $email->subject('link for reset password');
            $email->text('Voici le lien pour reset votre password');
            $email->html('<a href="reset_password">Cliquez ici</a>');
            $mailer->send($email);
        }

        return $this->render('forgotPassword.html.twig', ['forgotPassword' => $userConnectionForm->createView()]);
    }

    #[Route('/create_account', name: 'registration')]
    public function registrationUser(Request $request, UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $entityManager): Response
    {
        $user                 = new User();
        $userRegistrationForm = $this->createForm(RegistrationFormType::class, $user);
        $userRegistrationForm->handleRequest($request);
        if ($userRegistrationForm->isSubmitted() && $userRegistrationForm->isValid()) {
            $hashedPassword = $passwordEncoder->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('registration.html.twig', ['registration' => $userRegistrationForm->createView()]);
    }
}
