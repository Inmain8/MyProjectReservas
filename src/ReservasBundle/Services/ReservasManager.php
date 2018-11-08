<?php

namespace ReservasBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

Class ReeservasManager {

    private $container;
    private $em;
    private $validator;
    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @param ContainerInterface $container
     */
    public function __construct(EntityManager $entityManager,  ContainerInterface $container)
    {
        $this->container    = $container;
        $this->em           = $entityManager;
        $this->validator    = $this->container->get('validator');
    }

    public function createReserva($fechallegada, $fechasalida) {

    }

}