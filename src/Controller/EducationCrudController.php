<?php

namespace App\Controller;

use App\Entity\Educations;
use App\Form\EducationsType;
use App\Repository\EducationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/education/crud")
 */
class EducationCrudController extends AbstractController
{
    /**
     * @Route("/", name="app_education_crud_index", methods={"GET"})
     */
    public function index(EducationsRepository $educationsRepository): Response
    {
        return $this->render('education_crud/index.html.twig', [
            'activated' => 'education',
            'educations' => $educationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_education_crud_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EducationsRepository $educationsRepository): Response
    {
        $education = new Educations();
        $form = $this->createForm(EducationsType::class, $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $educationsRepository->add($education, true);

            return $this->redirectToRoute('app_education_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('education_crud/new.html.twig', [
            'education' => $education,
            'activated' => 'education',
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_education_crud_show", methods={"GET"})
     */
    public function show(Educations $education): Response
    {
        return $this->render('education_crud/show.html.twig', [
            'activated' => 'education',
            'education' => $education,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_education_crud_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Educations $education, EducationsRepository $educationsRepository): Response
    {
        $form = $this->createForm(EducationsType::class, $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $educationsRepository->add($education, true);

            return $this->redirectToRoute('app_education_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('education_crud/edit.html.twig', [
            'activated' => 'education',
            'education' => $education,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_education_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Educations $education, EducationsRepository $educationsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$education->getId(), $request->request->get('_token'))) {
            $educationsRepository->remove($education, true);
        }

        return $this->redirectToRoute('app_education_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
