<?php

namespace App\Controller\Admin;

use App\Entity\Modele;
use App\Form\ModeleType;
use App\Repository\ModeleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/modele")
 */
class ModeleController extends AbstractController
{
    /**
     * @Route("/", name="admin_modele_index", methods={"GET"})
     */
    public function index(ModeleRepository $modeleRepository): Response
    {
        return $this->render('admin/modele/index.html.twig', [
            'modeles' => $modeleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_modele_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $modele = new Modele();
        $form = $this->createForm(ModeleType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modele);
            $entityManager->flush();

            return $this->redirectToRoute('admin_modele_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/modele/new.html.twig', [
            'modele' => $modele,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_modele_show", methods={"GET"})
     */
    public function show(Modele $modele): Response
    {
        return $this->render('admin/modele/show.html.twig', [
            'modele' => $modele,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_modele_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Modele $modele): Response
    {
        $form = $this->createForm(ModeleType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_modele_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/modele/edit.html.twig', [
            'modele' => $modele,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_modele_delete", methods={"POST"})
     */
    public function delete(Request $request, Modele $modele): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modele->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($modele);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_modele_index', [], Response::HTTP_SEE_OTHER);
    }
}
