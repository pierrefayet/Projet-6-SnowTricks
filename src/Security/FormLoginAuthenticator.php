<?php

declare(strict_types=1);

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class FormLoginAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;
    private RouterInterface $router;
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(RouterInterface $router, UrlGeneratorInterface $urlGenerator)
    {
        $this->router       = $router;
        $this->urlGenerator = $urlGenerator;
    }

    public function authenticate(Request $request): Passport
    {
        $userForm = $request->request->all('user_form');
        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $userForm['userName']);

        return new Passport(
            new UserBadge(
                $userForm['userName'],
            ),
            new PasswordCredentials($userForm['password']),
            [
                new CsrfTokenBadge('authenticate', $userForm['_token']),
            ],
        );
    }

    public function onAuthenticationSuccess(Request $request, $token, string $firewallName): ?Response
    {
        dump('ici');
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->router->generate('home'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate('security_login');
    }
}
