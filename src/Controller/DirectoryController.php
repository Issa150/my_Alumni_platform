<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DirectoryController extends AbstractController
{
    #[Route('/annuaire', name: 'app_directory')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Utilisation de la méthode findAllByRole
        $AllUsers = $entityManager->getRepository(User::class)->findAllByRole();

        return $this->render('directory/index.html.twig', [
            'AllUsers'=> $AllUsers,
        ]);
    }
}
