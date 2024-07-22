<?php

namespace App\Controller;

use App\Entity\Emploi;
use App\Repository\EmploiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmploiController extends AbstractController
{
    #[Route('/emploi', name: 'app_emploi')]
    public function index(EntityManagerInterface $entityManager, EmploiRepository $emploiRepository): Response
    {
        // Utilisation de la méthode findAllEmploi de l'entity manager
        $emplois = $entityManager->getRepository(Emploi::class)->findAllEmplois();

        // Récupération des filtres
        $filterPublicationDates = $emploiRepository->findAllPublicationDates();
        $domains = $emploiRepository->findAllDomains();
        $locations = $emploiRepository->findAllCities();
        $skills = $emploiRepository->findAllSkills();
        $contracts = $emploiRepository->findAllContracts();
        $teleworkings = $emploiRepository->findAllTeleworkings();

        return $this->render('emploi/index.html.twig', [
            'emplois' => $emplois,
            'filterPublicationDates' => $filterPublicationDates,
            'domains' => $domains,
            'locations' => $locations,
            'skills' => $skills,
            'contracts' => $contracts,
            'teleworkings' => $teleworkings
        ]);
    }

    #[Route('/emploi/filter', name: 'emploi_filter')]
    public function filter(Request $request, EmploiRepository $emploiRepository): Response
    {
        $teleworking = $request->query->get('teleworking');
        $location = $request->query->get('location');
        $requiredLevel = $request->query->get('requiredLevel');
        $contract = $request->query->get('contract');
        $skills = $request->query->get('skills');
        $domain = $request->query->get('domain');
        $publicationDate = $request->query->get('publicationDate');

        $queryBuilder = $emploiRepository->createQueryBuilder('e');

        if ($teleworking) {
            $queryBuilder->andWhere('e.teleworking = :teleworking')
                ->setParameter('teleworking', $teleworking);
        }

        if ($location) {
            $queryBuilder->andWhere('e.city = :location')
                ->setParameter('location', $location);
        }

        if ($requiredLevel) {
            $queryBuilder->andWhere('e.requiredLevel = :requiredLevel')
                ->setParameter('requiredLevel', $requiredLevel);
        }

        if ($contract) {
            $queryBuilder->andWhere('e.contract = :contract')
                ->setParameter('contract', $contract);
        }

        if ($skills) {
            $queryBuilder->andWhere('e.skills = :skills')
                ->setParameter('skills', $skills);
        }

        if ($domain) {
            $queryBuilder->andWhere('e.field = :domain')
                ->setParameter('domain', $domain);
        }

        if ($publicationDate) {
            $queryBuilder->andWhere('e.publicationDate = :publicationDate')
                ->setParameter('publicationDate', $publicationDate);
        }

        $emplois = $queryBuilder->getQuery()->getResult();

        return $this->render('emploi/_job_cards.html.twig', [
            'emplois' => $emplois,
        ]);
    }
    


    #[Route('/emploi{id}', name: 'app_emploi_details')]
    public function detailEmploi(): Response
    {
        
        return $this->render('emploi/index.html.twig', [
            'controller_name' => 'EmploiController',
        ]);
    }

}