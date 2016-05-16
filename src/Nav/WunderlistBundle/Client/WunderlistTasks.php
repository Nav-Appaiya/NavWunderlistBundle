<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 15-05-16
 * Time: 21:42
 */

namespace Nav\WunderlistBundle\Client;


use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\SeekException;
use Symfony\Component\DependencyInjection\Container;
/*
 * @var $this->client Client
 */
class WunderlistTasks extends Wunderlist
{
    public function __construct(Container $container, EntityManager $entityManager)
    {
        $this->container = $container;
        $this->em = $entityManager;
    }

    public function getWunderlistAccountForTesting()
    {
        $accountRepo = $this->em->getRepository('NavWunderlistBundle:WunderlistAccount');
        $account = $accountRepo->find("51acf87c-1ada-11e6-a571-877de0eaf200");
        
        $this->client = new Client([
            'base_uri' => 'https://a.wunderlist.com/',
            'headers' => [
                'X-Access-Token' => $account->getAccessToken(),
                'X-Client-ID'     => $account->getClientId()
            ]
        ]);
        
        return $this->client;
    }

    public function getLists()
    {
        /* @var Client $client */
        $lists = $this->client->get('/api/v1/lists');

        return json_decode($lists->getBody()->getContents());
    }

    public function getTasksForListId($listId = false)
    {
        if(!$this->client){
            $this->client = $this->getWunderlistAccountForTesting();
        }
        if($listId){
            $tasks = $this->client->get('/api/v1/tasks', [
                'query' => [
                    'list_id' => $listId
                ]
            ]);

            return json_decode($tasks->getBody()->getContents());
        } else{
            throw new \Exception('Please provide a Wunderlist list id to retrieve tasks for it.');
        }
    }

    public function getFilesForListId($listId = false)
    {
        if($listId){
            $files = $this->client->get('/api/v1/files', [
                'query' => [
                    'list_id' => $listId
                ]
            ])->getBody()->getContents();
            
            return json_decode($files);
        } else{
            throw new \Exception('Please provide a Wunderlist list id to retrieve files for it.');
        }
    }

    public function createTask($listId = false, $title = false, $assigneeId = '13143132')
    {
        if($listId && $title){
        
            $newTaks = $this->client->request('POST', '/api/v1/tasks', [
                'json' => [
                    'list_id' => (int)$listId,
                    'title' => $title,
                    'assignee_id' => (int)$assigneeId,
                    'completed' => false,
                ]]);

            return json_decode($newTaks->getBody()->getContents());

        } else{
            throw new \Exception('Please provide a Wunderlist list id and a title for the task to be created.');
        }
    }

    public function createList($listTitle = false)
    {
        if($listTitle){
            $newList = $this->client->request('POST', '/api/v1/lists', [
                'json' => [
                    'title' => $listTitle
                ]
            ]);

            return json_decode($newList->getBody()->getContents());
        } else{
            throw new \Exception('Please provide a Wunderlist list title for the list to be created.');
        }
    }
}