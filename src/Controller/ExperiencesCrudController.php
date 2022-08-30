<?php

namespace App\Controller;

use App\Entity\Experiences;
use App\Form\ExperiencesType;
use App\Repository\ExperiencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/experiences/crud")
 */
class ExperiencesCrudController extends AbstractController
{
    /**
     * @Route("/", name="app_experiences_crud_index", methods={"GET"})
     */
    public function index(ExperiencesRepository $experiencesRepository): Response
    {
        return $this->render('experiences_crud/index.html.twig', [
            'experiences' => $experiencesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_experiences_crud_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ExperiencesRepository $experiencesRepository): Response
    {
        $experience = new Experiences();
        $form = $this->createForm(ExperiencesType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $experiencesRepository->add($experience, true);

            return $this->redirectToRoute('app_experiences_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('experiences_crud/new.html.twig', [
            'experience' => $experience,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_experiences_crud_show", methods={"GET"})
     */
    public function show(Experiences $experience): Response
    {
        return $this->render('experiences_crud/show.html.twig', [
            'experience' => $experience,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_experiences_crud_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Experiences $experience, ExperiencesRepository $experiencesRepository): Response
    {
        $form = $this->createForm(ExperiencesType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $experiencesRepository->add($experience, true);

            return $this->redirectToRoute('app_experiences_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('experiences_crud/edit.html.twig', [
            'experience' => $experience,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_experiences_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Experiences $experience, ExperiencesRepository $experiencesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experience->getId(), $request->request->get('_token'))) {
            $experiencesRepository->remove($experience, true);
        }

        return $this->redirectToRoute('app_experiences_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
