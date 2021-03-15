<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Orders;

class OrdersDataPersister implements ContextAwareDataPersisterInterface
{

    private $_entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->_entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Orders;
    }

    public function persist($data, array $context = [])
    {
        $data->setCreatedAt(new \DateTime("now", new \DateTimeZone('Europe/Paris')));

        for($i = 0; $i < count($data->getPlaces()); $i++){
            $data->getPlaces()[$i]->setIsReserved(true);
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