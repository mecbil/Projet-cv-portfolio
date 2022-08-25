<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompetencesController extends AbstractController
{
    /**
     * @Route("/competences", name="competences")
     */
    public function index(): Response
    {
        return $this->render('competences/competences.html.twig', [
            'activated' => 'competences',
            'controller_name' => 'CompetencesController',
        ]);
    }
}
