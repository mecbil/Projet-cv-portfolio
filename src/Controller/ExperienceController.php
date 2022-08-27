<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperienceController extends AbstractController
{
    /**
     * @Route("/experiences", name="experiences")
     */
    public function index(): Response
    {
        return $this->render('experience/experiences.html.twig', [
            'activated' => 'experiences',
            'controller_name' => 'ExperienceController',
        ]);
    }
}
