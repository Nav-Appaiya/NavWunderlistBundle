<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 15-05-16
 * Time: 21:42
 */

namespace Nav\WunderlistBundle\Client;


use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class WunderlistTasks extends Wunderlist
{
    public function __construct(Container $container, EntityManager $entityManager)
    {
        $this->container = $container;
        $this->em = $entityManager;
    }

    // Return list of tasks for listid
    public function getTasksForListId($list_id)
    {
        if (isset($list_id)) {
            $client = $this->client;
            echo '<pre>';
            var_dump($client);exit;
        } else{
            return false;
        }
    }
}