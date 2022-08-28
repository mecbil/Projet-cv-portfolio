<?php

namespace App\Controller;

use App\Repository\CompetencesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompetencesController extends AbstractController
{
    /**
     * @Route("/competences", name="competences")
     */
    public function index(CompetencesRepository $competencesRepository): Response
    {
        return $this->render('competences/competences.html.twig', [
            'competences' => $competencesRepository->findAll(),
            'activated' => 'competences',
            'controller_name' => 'CompetencesController',
        ]);
    }
}
