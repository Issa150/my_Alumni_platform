<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DirectoryController extends AbstractController
{
    #[Route('/annuaire', name: 'app_directory')]
    public function index(): Response
    {
        return $this->render('directory/index.html.twig', [
            'controller_name' => 'DirectoryController',
        ]);
    }
}
