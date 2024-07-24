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

        // Get user ID
        $user = $token->getUser();
        $id = $user->getId();
        $first_name = $user->getFirstname();
        $last_name = $user->getLastname();
        $study_field = $user->getStudyField();
        $gender = $user->getGender();
        $certificate_obtention = $user->getCertificateObtention();
        $city = $user->getCity();
        $country = $user->getCountry();

        // Check if the user has the admin role
        if (in_array('ROLE_ADMIN', $roles)) {
            // Redirect to admin dashboard
            return new RedirectResponse($this->router->generate('admin'));
        }

        // Les champs requis de la page profile doivent être renseignés, sinon à chaque connexion l'utilisateur sera toujours redirigé sur le formulaire de la page de profile
        if($first_name == NULL || $last_name == NULL || $study_field == NULL || $gender == NULL || $certificate_obtention == NULL || $city == NULL || $country == NULL){
            return new RedirectResponse($this->router->generate('my_profile', ['id' => $id]));
        }

        // Default redirection for other users (my profile only for now, must be changed later)
        return new RedirectResponse($this->router->generate('app_main'));
    }
}
