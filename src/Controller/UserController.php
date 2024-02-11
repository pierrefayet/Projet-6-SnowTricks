<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgotFormType;
use App\Form\LoginFormType;
use App\Form\RegistrationType;
use App\Form\ResetFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use App\Security\FormLoginAuthenticator;
use Exception;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class UserController extends AbstractController
{
    public function __construct(private readonly EmailVerifier $emailVerifier)
    {
    }

    #[Route('/login', name: 'security_login')]
    public function loginUser(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $user = new User();
        $userConnectionForm = $this->createForm(LoginFormType::class, $user);
        $userConnectionForm->handleRequest($request);
        return $this->render('login.html.twig', [
            'connection' => $userConnectionForm->createView(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'lastUserName' => $authenticationUtils->getLastUsername()
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/logout', name: 'security_logout')]
    public function logOut(): void
    {
        throw new Exception('This should never be reached');
    }

    #[Route('/reset_password', name: 'reset_password')]
    public function resetPassword(Request $request): Response
    {
        $user = new User();
        $userConnectionForm = $this->createForm(ResetFormType::class, $user);
        $userConnectionForm->handleRequest($request);
        if ($userConnectionForm->isSubmitted() && $userConnectionForm->isValid()) {
            return $this->redirectToRoute('home');
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
    public function registrationUser(
        Request $request, UserPasswordHasherInterface $passwordEncoder,
        EntityManagerInterface $entityManager,
        UserAuthenticatorInterface $userAuthenticator,
        FormLoginAuthenticator $authenticator
    ): Response
    {
        $user = new User();
        $userRegistrationForm = $this->createForm(RegistrationType::class, $user);
        $userRegistrationForm->handleRequest($request);
        if ($userRegistrationForm->isSubmitted() && $userRegistrationForm->isValid()) {
            $hashedPassword = $passwordEncoder->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('snowtrick@gmail.com', 'admin'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );

        }

        return $this->render('registration.html.twig', ['registration' => $userRegistrationForm->createView()]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UserRepository $userRepository): Response
    {
        $id = $request->query->get('id');

        if (null === $id) {
            return $this->redirectToRoute('notFoundPage');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('notFoundPage');
        }

        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('forgot_password');
        }

        $this->addFlash('home', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
}
