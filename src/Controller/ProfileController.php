<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{

    #[Route('/profile/{id}', name: 'app_profile')]
    public function profileUser(UserRepository $userRepository, int $id): Response
    {

        $user =$userRepository->findOneById($id);

        return $this->render('profile/pages/feeds.twig', [
            'controller_name' => 'ProfileController',
            'user' => $user
        ]);
    }


    #[Route('/profile/feeds/{id}', name: 'my_feeds')]
    public function feeds(UserRepository $userRepository, int $id): Response
    {
        $user =$userRepository->findOneById($id);
        return $this->render('profile/pages/feeds.twig',[
            'user' => $user
        ]);

    }

    #[Route('/profile/resources/{id}', name: 'my_sources')]
    public function sources(UserRepository $userRepository, int $id): Response
    {
        $user =$userRepository->findOneById($id);
        return $this->render('profile/pages/resources.twig',[
            'user' => $user
        ]);
    }

    #[Route('/profile/my_profile/{id}', name: 'my_profile')]
    public function myProfile(UserRepository $userRepository, int $id): Response
    {
        $user =$userRepository->findOneById($id);
        return $this->render('profile/pages/my_profile.twig',[
            'user' => $user
        ]);
        
    }

    
    #[Route('/profile/likes/{id}', name: 'my_likes')]
    public function likes(UserRepository $userRepository, int $id): Response
    {
        $user =$userRepository->findOneById($id);
        return $this->render('profile/pages/likes.twig',[
            'user' => $user
        ]);
    }

    #[Route('/profile/abonnement/{id}', name: 'my_abonnement')]
    public function contacts(UserRepository $userRepository, int $id): Response
    {
        $user =$userRepository->findOneById($id);
        return $this->render('profile/pages/follow.twig',[
            'user' => $user
        ]);
    }



    // #[Route('/profile/my_posts', name: 'my_posts')]
    // public function posts(): Response
    // {
    //     return $this->render('profile/my_posts.twig');
    // }
}
