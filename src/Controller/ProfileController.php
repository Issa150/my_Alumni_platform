<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        // return $this->render('profile/profile_layout.html.twig', [
        return $this->render('profile/pages/feeds.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    #[Route('/profile/feeds', name: 'my_feeds')]
    public function feeds(): Response
    {
        return $this->render('profile/pages/feeds.twig');
    }

    #[Route('/profile/resources', name: 'my_sources')]
    public function sources(): Response
    {
        return $this->render('profile/pages/resources.twig');
    }

    #[Route('/profile/my_profile', name: 'my_profile')]
    public function myProfile(): Response
    {
        return $this->render('profile/pages/my_profile.twig');
    }

    
    #[Route('/profile/likes', name: 'my_likes')]
    public function likes(): Response
    {
        return $this->render('profile/pages/likes.twig');
    }

    #[Route('/profile/abonnement', name: 'my_abonnement')]
    public function contacts(): Response
    {
        return $this->render('profile/pages/follow.twig');
    }



    // #[Route('/profile/my_posts', name: 'my_posts')]
    // public function posts(): Response
    // {
    //     return $this->render('profile/my_posts.twig');
    // }
}
