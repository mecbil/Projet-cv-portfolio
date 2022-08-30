<?php

namespace App\Controller;

use App\Repository\ExperiencesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExperienceController extends AbstractController
{
    /**
     * @Route("/experiences", name="experiences")
     */
    public function index(ExperiencesRepository $experiencesRepository): Response
    {
        return $this->render('experience/experiences.html.twig', [
            'experiences' => $experiencesRepository->findAll(),
            'activated' => 'experiences',
            'controller_name' => 'ExperienceController',
        ]);
    }
}
