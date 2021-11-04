<?php

namespace App\Controller\Admin;

use App\Entity\Abonnement;
use App\Entity\Client;
use App\Form\AbonnementClientType;
use App\Form\AbonnementType;
use App\Form\ClientType;
use App\Repository\AbonnementRepository;
use App\Repository\ClientRepository;
use App\Service\Abonnement\AbonnementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="admin_client_index", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('admin/client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
            'parent_page'=>'Abonnement'
        ]);
    }

    /**
     * @Route("/new", name="admin_client_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('admin_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/client/new.html.twig', [
            'client' => $client,
            'form' => $form,
            'parent_page'=>'Client'
        ]);
    }

    /**
     * @Route("/{id}", name="admin_client_show", methods={"GET"})
     */
    public function show(Client $client, AbonnementRepository $abonnementRepository): Response
    {
        return $this->render('admin/client/show.html.twig', [
            'client' => $client,
            'En_cour'=>$abonnementRepository->etat('En cour', $client),
            'Anuller'=>$abonnementRepository->etat('Annuller', $client),
            'Terminer'=>$abonnementRepository->etat('Terminer', $client)
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Client $client): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/client/edit.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_client_delete", methods={"POST"})
     */
    public function delete(Request $request, Client $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
