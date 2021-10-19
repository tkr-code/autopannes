<?php

namespace App\Service\Client;

use App\Repository\ClientRepository;

class ClientService
{
    private $clientRepository;
    public function __construct(ClientRepository $clientRepository)
    {
       $this->clientRepository = $clientRepository;
    }
    public function clientNumber()
    {
        $number= 1;
        $items = $this->clientRepository->findAll();
        foreach($items as $item)
        {
           $number += $item->getNumber();
        }
        return  sprintf("%06s", $number);
    }
}
