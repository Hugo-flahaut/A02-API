<?php

namespace App\DataPersister;

use App\Entity\Places;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class PlacesDataPersister implements DataPersisterInterface
{

    private $_entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->_entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Places;
    }

    public function persist($data, array $context = [])
    {
        
        if($data->getOrders() == null){
            $data->setIsReserved(false);
            return $data;
        } else{
            $data->setIsReserved(true);
            return $data;
        }

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
        return $data;
    }

    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}