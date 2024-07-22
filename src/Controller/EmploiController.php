<?php

namespace App\Controller;

use App\Repository\EmploiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmploiController extends AbstractController
{
    #[Route('/emploi', name: 'app_emploi')]
    public function index(): Response
    {
        
        return $this->render('emploi/index.html.twig', [
            'controller_name' => 'EmploiController',
        ]);
    }



}