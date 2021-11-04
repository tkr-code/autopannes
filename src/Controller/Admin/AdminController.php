<?php

namespace App\Controller\Admin;

use App\Repository\AbonnementRepository;
use App\Repository\ClientRepository;
use App\Repository\FormuleRepository;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class AdminController extends AbstractController
{
    private $translator;
    public function __construct(TranslatorInterface $translatorInterface)
    {
        $this->translator = $translatorInterface;
    }
    /**
     * @Route("/admin/", name="admin")
     */
    public function index(ClientRepository $clientRepository, FormuleRepository $formuleRepository, AbonnementRepository $abonnementRepository, VehiculeRepository $vehiculeRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'abonnements'=>$abonnementRepository->findAll(),
            'vehicules'=>$vehiculeRepository->findAll(),
            'formules'=>$formuleRepository->findAll(),
            'clients'=>$clientRepository->findAll(),
            'parent_page'=>$this->translator->trans('Dashboard')
        ]);
    }
}
