<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticleDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    /**
     * @param SluggerInterface
     */
    private $_slugger;

    /**
     * @param Request
     */
    private $_request;

    public function __construct(
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger,
        RequestStack $request
    ) {
        $this->_entityManager = $entityManager;
        $this->_slugger = $slugger;
        $this->_request = $request->getCurrentRequest();
    }


    public function supports($data, array $context = []): bool
    {
        return $data instanceof Restaurant;
    }

    public function persist($data, array $context = [])
    {

        $data->setSlug(
            $this
                ->_slugger
                ->slug(strtolower($data->getTitle())). '-' .uniqid()
        );

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}
