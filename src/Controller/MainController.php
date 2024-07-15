<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Emploi;
use App\Entity\Formation;
use App\Entity\Event;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(EntityManagerInterface $entityManager): Response
    {
       
        $lastUsers = $entityManager->getRepository(User::class)->findLastThree();
        $lastFormations = $entityManager->getRepository(Formation::class)->findLastThree();
        $lastEmplois = $entityManager->getRepository(Emploi::class)->findLastThree();

        $countUsers = $entityManager->getRepository(User::class)->findByNumberAlumnis();
        $countEmplois = $entityManager->getRepository(Emploi::class)->findByNumberEmplois();
        $countEvents = $entityManager->getRepository(Event::class)->findByNumberEvents();

        // $user= false;
        return $this->render('main/index.html.twig', [
            'lastUsers'=> $lastUsers,
            'lastFormations'=> $lastFormations,
            'lastEmplois'=> $lastEmplois,
            'countUsers' => $countUsers,
            'countEmplois' => $countEmplois,
            'countEvents' => $countEvents,

        ]);
    }
}
