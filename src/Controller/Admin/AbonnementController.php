<?php

namespace App\Controller\Admin;

use App\Entity\Abonnement;
use App\Form\AbonnementType;
use App\Form\AbonnementClientType;
use App\Repository\AbonnementRepository;
use App\Service\Abonnement\AbonnementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/abonnement")
 */
class AbonnementController extends AbstractController
{
    /**
     * @Route("/", name="admin_abonnement_index", methods={"GET"})
     */
    public function index(AbonnementRepository $abonnementRepository): Response
    {
        return $this->render('admin/abonnement/index.html.twig', [
            'en_cour' => $abonnementRepository->etat('En cour'),
            'annuler'=>$abonnementRepository->etat('Annuler'),
            'terminer'=>$abonnementRepository->etat('Terminer'),
            'parent_page'=>'Abonnement'
        ]);
    }
    /**
     * @Route("/new", name="admin_abonnement_new", methods={"GET","POST"})
     */
    public function new(Request $request, AbonnementService $abonnementService): Response
    {
        $abonnement = new Abonnement();
        $form = $this->createForm(AbonnementClientType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abonnement->setNumber($abonnementService->number());
            
            $vehicule = $abonnement->getVehicule();
            $vehicule->setClient($abonnement->getClient());
            
            $payment = $abonnement->getPayment();
            $payment ->setAmount( $vehicule->getFormule()->getAmount());
            $abonnement->setPayment($payment);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($abonnement);
            $entityManager->flush();
            $this->addFlash('success','Abonnement enregistré');
            return $this->redirectToRoute('admin_abonnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/abonnement/new.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form,
            'parent_page'=>'Abonnement'
        ]);
    }

    /**
     * @Route("/{id}", name="admin_abonnement_show", methods={"GET"})
     */
    public function show(Abonnement $abonnement): Response
    {
        return $this->render('admin/abonnement/show.html.twig', [
            'abonnement' => $abonnement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_abonnement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Abonnement $abonnement): Response
    {
        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Abonnement modifié');
            return $this->redirectToRoute('admin_abonnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/abonnement/edit.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_abonnement_delete", methods={"POST"})
     */
    public function delete(Request $request, Abonnement $abonnement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abonnement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($abonnement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_abonnement_index', [], Response::HTTP_SEE_OTHER);
    }
}
