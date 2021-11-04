<?php

namespace App\Controller\Admin;

use App\Entity\Formule;
use App\Form\FormuleType;
use App\Repository\FormuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/formule")
 */
class FormuleController extends AbstractController
{
    /**
     * @Route("/", name="admin_formule_index", methods={"GET"})
     */
    public function index(FormuleRepository $formuleRepository): Response
    {
        return $this->render('admin/formule/index.html.twig', [
            'formules' => $formuleRepository->findAll(),
            'parent_page'=>'Formule'
        ]);
    }

    /**
     * @Route("/new", name="admin_formule_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formule = new Formule();
        $form = $this->createForm(FormuleType::class, $formule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formule);
            $entityManager->flush();

            return $this->redirectToRoute('admin_formule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/formule/new.html.twig', [
            'formule' => $formule,
            'form' => $form,
            'parent_page'=>'Formule'
        ]);
    }

    /**
     * @Route("/{id}", name="admin_formule_show", methods={"GET"})
     */
    public function show(Formule $formule): Response
    {
        return $this->render('admin/formule/show.html.twig', [
            'formule' => $formule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_formule_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formule $formule): Response
    {
        $form = $this->createForm(FormuleType::class, $formule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_formule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/formule/edit.html.twig', [
            'formule' => $formule,
            'form' => $form,
            'parent_page'=>'Formule'
        ]);
    }

    /**
     * @Route("/{id}", name="admin_formule_delete", methods={"POST"})
     */
    public function delete(Request $request, Formule $formule): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_formule_index', [], Response::HTTP_SEE_OTHER);
    }
}
