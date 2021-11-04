<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Personne;
use App\Entity\Abonnement;
use App\Form\SouscriptionType;
use App\Repository\ClientRepository;
use App\Service\Abonnement\AbonnementService;
use App\Service\Client\ClientService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SouscriptionController extends AbstractController
{
    /**
     * @Route("/admin/souscription", name="admin_souscription")
     */
    public function new(Request $request,AbonnementService $abonnementService, ClientService $clientService, ClientRepository $clientRepository): Response
    {
        $abonnement = new Abonnement();
        // $personne  = new Personne();
        // $personne->setFirstName('Malick')
        // ->setLastName('Tounkara');
        // $client = new Client();
        // $client->setPersonne($personne)
        // ->setEmail('malick@gmail.com')
        // ->setAddress('Petit paris')
        // ->setPostalCode('11000')
        // ->setPhoneNumber('781278288')
        // ->setCity('Libreville');
        // $abonnement->setClient($client);
        // dd($abonnement);
        $form = $this->createForm(SouscriptionType::class,$abonnement);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $client = $abonnement->getClient();
            $client->setNumber($clientService->clientNumber());
            $abonnement->setClient($client);
            $abonnement->setNumber($abonnementService->number());
            // payment
            $payment = $abonnement->getPayment();
           //formule and vehicule
            $vehicule = $abonnement->getVehicule();
            $vehicule->setClient($client);
            $payment ->setAmount( $vehicule->getFormule()->getAmount());
            $abonnement->setPayment($payment);
            
            // dd($abonnement);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($abonnement);
            $entityManager->flush();
            $this->addFlash('success','Souscription enregistrée');

            return $this->redirectToRoute('admin_abonnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/souscription/index.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form,
            'parent_page'=>'Souscription'
        ]);
    }
}
