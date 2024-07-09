<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class CustomAuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        // Get user roles
        $roles = $token->getRoleNames();

        // Check if the user has the admin role
        if (in_array('ROLE_ADMIN', $roles)) {
            // Redirect to admin dashboard
            return new RedirectResponse($this->router->generate('admin'));
        }

        // Default redirection for other users
        return new RedirectResponse($this->router->generate('app_main'));
    }
}
