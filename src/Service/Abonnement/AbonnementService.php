<?php

namespace App\Service\Abonnement;

use App\Repository\AbonnementRepository;
use App\Repository\ClientRepository;

class AbonnementService
{
    private $abonnementRepository;
    public function __construct(AbonnementRepository $abonnementRepository)
    {
       $this->abonnementRepository = $abonnementRepository;
    }
    public function number()
    {
        $number= 1;
        $items = $this->abonnementRepository->findLast();
        foreach($items as $item)
        {
           $number += $item->getNumber();
        }
        return  sprintf("%06s", $number);
    }
}
