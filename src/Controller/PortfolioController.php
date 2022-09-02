<?php

namespace App\Controller;

use App\Repository\RealisationsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function index(RealisationsRepository $realisationsRepository): Response
    {
        return $this->render('portfolio/portfolio.html.twig', [
            'realisations' => $realisationsRepository->findAll(),
            'activated' => 'portfolio',
            'controller_name' => 'PortfolioController',
        ]);
    }
}
