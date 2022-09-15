<?php

namespace App\Controller;

use App\Repository\EducationsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EducationController extends AbstractController
{
    /**
     * @Route("/education", name="education")
     */
    public function index(EducationsRepository $competencesRepository, Request $request): Response
    {
        $limit = 10;
        $page = (int)$request->query->get('page', 1);
        $total = $competencesRepository->findAll();

        $education = $competencesRepository->findBy([], [], $limit,$page*$limit-$limit);

        return $this->render('education/education.html.twig', [
            'educations' => $education,
            'activated' => 'education',
            'page' => $page,
            'total' => count($total),
            'limit' => $limit,
            'controller_name' => 'EducationController',
        ]);
    }
}
