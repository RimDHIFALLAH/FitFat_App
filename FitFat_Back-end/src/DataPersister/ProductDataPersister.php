<?php

// src/DataPersister

namespace App\DataPersister;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

/**
 *
 */
class ProductDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;
    private $_slugger;

    public function __construct(
        EntityManagerInterface $entityManager
 
    ) {
        $this->_entityManager = $entityManager;
       
    }


    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Article;
    }

    /**
     * @param Product $data
     */
    public function persist($data, array $context = [])
    {
       

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}