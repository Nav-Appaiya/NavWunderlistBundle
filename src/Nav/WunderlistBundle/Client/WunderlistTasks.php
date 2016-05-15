<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 15-05-16
 * Time: 21:42
 */

namespace Nav\WunderlistBundle\Client;


use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class WunderlistTasks extends Wunderlist
{
    public function __construct(ContainerAwareInterface $container, EntityManager $entityManager)
    {
        parent::__construct();
        $this->container = $container;
        $this->em = $entityManager;
    }

    public function getListOfTasks()
    {
        return 'listings';
    }
}