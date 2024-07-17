<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DirectoryController extends AbstractController
{
    #[Route('/annuaire', name: 'app_directory')]
    public function index(EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        // Utilisation de la méthode findAllUsers de l'entity manager
        $users = $entityManager->getRepository(User::class)->findAllUsers();

        // Récupération des années de promotion
        $promotionYears = [];
        $certificateYears = $userRepository->findAllCertificateYearObtention();
        foreach ($certificateYears as $certificateYear) {
            // Assurez-vous que $certificateYear est bien un objet DateTimeImmutable
            if ($certificateYear instanceof \DateTimeImmutable) {
                $promotionYears[] = $certificateYear->format('Y');
            }
        }

        // Récupération des domaines d'activité
        $activityDomains = $userRepository->findAllStudyField();

        // Récupération des localisations
        $locations = $userRepository->findAllCities();

        return $this->render('directory/index.html.twig', [
            'users' => $users,
            'promotionYears' => $promotionYears,
            'activityDomains' => $activityDomains,
            'locations' => $locations
        ]);
    }
}
