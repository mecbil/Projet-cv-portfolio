<?php

namespace App\Controller;

use App\Entity\Realisations;
use App\Form\RealisationsType;
use App\Repository\RealisationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/realisations/crud")
 */
class RealisationsCrudController extends AbstractController
{
    /**
     * @Route("/", name="app_realisations_crud_index", methods={"GET"})
     */
    public function index(RealisationsRepository $realisationsRepository): Response
    {
        return $this->render('realisations_crud/index.html.twig', [
            'realisations' => $realisationsRepository->findAll(),
            'activated' => 'portfolio',
        ]);
    }

    /**
     * @Route("/new", name="app_realisations_crud_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RealisationsRepository $realisationsRepository): Response
    {
        $realisation = new Realisations();
        $form = $this->createForm(RealisationsType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $realisationsRepository->add($realisation, true);

            return $this->redirectToRoute('app_realisations_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('realisations_crud/new.html.twig', [
            'realisation' => $realisation,
            'form' => $form,
            'activated' => 'portfolio',
        ]);
    }

    /**
     * @Route("/{id}", name="app_realisations_crud_show", methods={"GET"})
     */
    public function show(Realisations $realisation): Response
    {
        return $this->render('realisations_crud/show.html.twig', [
            'realisation' => $realisation,
            'activated' => 'portfolio',
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_realisations_crud_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Realisations $realisation, RealisationsRepository $realisationsRepository): Response
    {
        $form = $this->createForm(RealisationsType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $realisationsRepository->add($realisation, true);

            return $this->redirectToRoute('app_realisations_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('realisations_crud/edit.html.twig', [
            'realisation' => $realisation,
            'form' => $form,
            'activated' => 'portfolio',
        ]);
    }

    /**
     * @Route("/{id}", name="app_realisations_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Realisations $realisation, RealisationsRepository $realisationsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$realisation->getId(), $request->request->get('_token'))) {
            $realisationsRepository->remove($realisation, true);
        }

        return $this->redirectToRoute('app_realisations_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
