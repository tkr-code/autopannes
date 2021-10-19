<?php

namespace App\Controller\Admin;

use App\Repository\AbonnementRepository;
use App\Repository\ClientRepository;
use App\Repository\FormuleRepository;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/", name="admin")
     */
    public function index(ClientRepository $clientRepository, FormuleRepository $formuleRepository, AbonnementRepository $abonnementRepository, VehiculeRepository $vehiculeRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'abonnements'=>$abonnementRepository->findAll(),
            'vehicules'=>$vehiculeRepository->findAll(),
            'formules'=>$formuleRepository->findAll(),
            'clients'=>$clientRepository->findAll()
        ]);
    }
}
