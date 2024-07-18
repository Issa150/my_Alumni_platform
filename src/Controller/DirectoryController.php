<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

        $certificateYears = $userRepository->findAllCertificateYearObtention();


        // Récupération des domaines d'activité
        $activityDomains = $userRepository->findAllStudyField();

        // Récupération des localisations
        $locations = $userRepository->findAllCities();


        return $this->render('directory/index.html.twig', [
            'users' => $users,
            'certificateYears' => $certificateYears,
            'activityDomains' => $activityDomains,
            'locations' => $locations
        ]);
    }

    #[Route('/directory/filter', name: 'directory_filter')]
    public function filter(Request $request, UserRepository $userRepository): Response
    {
        $year = $request->query->get('year');
        $domain = $request->query->get('domain');
        $location = $request->query->get('location');

        $queryBuilder = $userRepository->createQueryBuilder('u');

        if ($year) {
            $queryBuilder->andWhere('u.certificateObtention = :year')
                ->setParameter('year', $year);
        }

        if ($domain) {
            $queryBuilder->andWhere('u.studyField = :domain')
                ->setParameter('domain', $domain);
        }

        if ($location) {
            $queryBuilder->andWhere('u.city = :location')
                ->setParameter('location', $location);
        }

        $users = $queryBuilder->getQuery()->getResult();

        return $this->render('directory/_user_cards.html.twig', [
            'users' => $users,
        ]);
    }
}
