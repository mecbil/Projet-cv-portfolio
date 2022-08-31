<?php

namespace App\Controller;

use App\Repository\EducationsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EducationController extends AbstractController
{
    /**
     * @Route("/education", name="education")
     */
    public function index(EducationsRepository $competencesRepository): Response
    {
        return $this->render('education/education.html.twig', [
            'educations' => $competencesRepository->findAll(),
            'activated' => 'education',
            'controller_name' => 'EducationController',
        ]);
    }
}
