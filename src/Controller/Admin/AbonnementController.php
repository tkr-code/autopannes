<?php

namespace App\Controller\Admin;

use App\Entity\Abonnement;
use App\Entity\Client;
use App\Entity\Personne;
use App\Form\AbonnementType;
use App\Form\AbonnemntEditType;
use App\Repository\AbonnementRepository;
use App\Repository\ClientRepository;
use App\Service\Client\ClientService;
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
            'abonnements' => $abonnementRepository->findAll(),
            'parent_page'=>'Abonnement'
        ]);
    }

    /**
     * @Route("/new", name="admin_abonnement_new", methods={"GET","POST"})
     */
    public function new(Request $request, ClientService $clientService, ClientRepository $clientRepository): Response
    {
        $abonnement = new Abonnement();
        $personne  = new Personne();
        $personne->setFirstName('Malick')
        ->setLastName('Tounkara');
        $client = new Client();
        $client->setPersonne($personne)
        ->setEmail('malick@gmail.com')
        ->setAddress('Petit paris')
        ->setPostalCode('11000')
        ->setPhoneNumber('781278288')
        ->setCity('Libreville');
        $abonnement->setClient($client);
        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $client->setNumber($clientService->clientNumber());
            $abonnement->setClient($client);
            // payment
           $payment = $abonnement->getPayment();
           $payment->setAmount($abonnement->getFormule()->getAmount());
           //formule and vehicule
           $forule = $abonnement->getFormule();
            $vehicule = $abonnement->getVehicule();
            $vehicule->setFormule($forule);
            $abonnement->setVehicule($vehicule);
            // dd($abonnement);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($abonnement);
            $entityManager->flush();

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
        $form = $this->createForm(AbonnemntEditType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

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
