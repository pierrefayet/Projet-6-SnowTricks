<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgotFormType;
use App\Form\LoginFormType;
use App\Form\ProfileEmailType;
use App\Form\ProfileImageType;
use App\Form\ProfileUserNameType;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use App\Security\FormLoginAuthenticator;
use App\Services\ImageService;
use App\Services\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class UserController extends AbstractController
{
    public function __construct(
        private readonly EmailVerifier $emailVerifier,
        private readonly TranslatorInterface $translator,
    ) {
    }

    #[Route('/login', name: 'security_login')]
    public function loginUser(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $user      = new User();
        $loginForm = $this->createForm(LoginFormType::class, $user);
        $loginForm->handleRequest($request);

        return $this->render('user/login.html.twig', [
            'connection'   => $loginForm->createView(),
            'error'        => $authenticationUtils->getLastAuthenticationError(),
            'lastUserName' => $authenticationUtils->getLastUsername(),
        ]);
    }

    #[Route('/logout', name: 'security_logout')]
    public function logOut(): void
    {
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/forgot_password', name: 'forgot_password')]
    public function forgotPassword(
        Request $request,
        EmailVerifier $emailVerifier,
        UserRepository $userRepository,
    ): Response {
        $user       = new User();
        $forgotForm = $this->createForm(ForgotFormType::class, $user);
        $forgotForm->handleRequest($request);
        if ($forgotForm->isSubmitted()) {
            $userEmail = $forgotForm->get('email')->getData();
            $user      = $userRepository->findOneByEmail($userEmail);
            if ($user) {
                $emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                    (new TemplatedEmail())
                        ->from(new Address('snowtrick@gmail.com', 'admin'))
                        ->to($user->getEmail())
                        ->subject('Please Confirm your Email')
                        ->htmlTemplate('registration/confirmation_email.html.twig'),
                );

                $this->addFlash('success', $this->translator->trans('user.success.login'));
            }
        }

        return $this->render('user/forgotPassword.html.twig', ['forgotPassword' => $forgotForm->createView()]);
    }

    #[Route('/create_account', name: 'registration')]
    public function registrationUser(
        Request $request, UserPasswordHasherInterface $passwordEncoder,
        EntityManagerInterface $entityManager,
        UserAuthenticatorInterface $userAuthenticator,
        FormLoginAuthenticator $authenticator,
        EmailVerifier $emailVerifier,
    ): ?Response {
        $user       = new User();
        $createForm = $this->createForm(RegistrationType::class, $user);
        $createForm->handleRequest($request);
        if ($createForm->isSubmitted() && $createForm->isValid() && $user->getPassword()) {
            $hashedPassword = $passwordEncoder->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();
            if ($user->getEmail()) {
                $emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                    (new TemplatedEmail())
                        ->from(new Address('snowtrick@gmail.com', 'admin'))
                        ->to($user->getEmail())
                        ->subject('Please Confirm your Email')
                        ->htmlTemplate('registration/confirmation_email.html.twig'),
                );

                $this->addFlash('success', $this->translator->trans('user.success.create_account'));

                return $userAuthenticator->authenticateUser(
                    $user,
                    $authenticator,
                    $request,
                );
            }
        }

        return $this->render('user/registration.html.twig', ['registration' => $createForm->createView()]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UserRepository $userRepository): Response
    {
        $id = $request->query->get('id');

        if (null === $id) {
            return $this->redirectToRoute(route: '_preview_error');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute(route: '_preview_error');
        }

        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('forgot_password');
        }

        $this->addFlash('success', $this->translator->trans('user.success.verify_email'));

        return $this->redirectToRoute('home');
    }

    #[Route('/profile', name: 'profile')]
    public function modifyProfile(
        Request $request,
        EntityManagerInterface $entityManager, ImageService $imageService,
    ): Response {
        $user         = $this->getUser();
        $formUsername = $this->createForm(ProfileUserNameType::class, $user);
        $formUsername->handleRequest($request);
        $emailForm = $this->createForm(ProfileEmailType::class, $user);
        $emailForm->handleRequest($request);
        $imageForm = $this->createForm(ProfileImageType::class, $user);
        $imageForm->handleRequest($request);

        if ($formUsername->isSubmitted() && $formUsername->isValid()) {
            $entityManager->flush();
        }

        if ($emailForm->isSubmitted() && $emailForm->isValid()) {
            $entityManager->flush();
        }

        if ($imageForm->isSubmitted() && $imageForm->isValid()) {
            $file = $imageForm->get('userImage')->getData();
            if ($file && $user instanceof User) {
                $user->setUserImage($imageService->buildImage($file, '/avatar'));
            }

            $entityManager->flush();
            $this->addFlash('success', $this->translator->trans('user.success.update_profile'));
        }

        return $this->render('user/profile.html.twig', [
            'profileUsername' => $formUsername->createView(),
            'profileEmail'    => $emailForm->createView(),
            'profileImage'    => $imageForm->createView(),
        ]);
    }
}
