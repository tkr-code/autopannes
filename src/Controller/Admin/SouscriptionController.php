<?php

namespace App\Controller\Admin;

use App\Form\SouscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SouscriptionController extends AbstractController
{
    /**
     * @Route("/admin/souscription", name="admin_souscription")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(SouscriptionType::class,[]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($formule);
            $entityManager->flush();

            return $this->redirectToRoute('admin_formule_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin/souscription/index.html.twig', [
            'form' =>$form,
        ]);
    }
}
