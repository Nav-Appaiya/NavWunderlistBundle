<?php

namespace AppBundle\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends Controller
{
    /**
     * @Route("/test", name="test_index")
     * List tasks from list: 141965745
     * access_token: c90f6a63e5580fa24f68 (om 23:21)
     *
     */
    public function indexAction()
    {
        $taskService = $this->get('nav_wunderlist.tasks');
        $client = $taskService->getWunderlistAccountForTesting();

        $lists = $taskService->getLists();
        $tasks = $taskService->getTasksForListId("141965745");
        $files = $taskService->getFilesForListId("141965745");

        $newTask = $taskService->createTask("250495195", "Nieuwe taak via API");
        $newList = $taskService->createList("Mijn nieuwe lijst");

        print_r($newList);
        exit;
    }

    public function getListsAndTasks()
    {
        $client = new Client([
            'base_uri' => 'https://a.wunderlist.com/',
            'headers' => [
                'X-Access-Token' => 'bec8cde9f07d6c618b4ea92cc291e4d542dadc6531dcabe084df27b39675',
                'X-Client-ID' => '21f6e505604ffff759c4'
            ]
        ]);

        $lists = $client->request('GET', '/api/v1/lists', [
            'headers' => [
                'X-Access-Token' => 'bec8cde9f07d6c618b4ea92cc291e4d542dadc6531dcabe084df27b39675',
                'X-Client-ID' => '21f6e505604ffff759c4'
            ]
        ]);

        $tasks = $client->request('GET', '/api/v1/tasks', [
            'headers' => [
                'X-Access-Token' => 'bec8cde9f07d6c618b4ea92cc291e4d542dadc6531dcabe084df27b39675',
                'X-Client-ID' => '21f6e505604ffff759c4'
            ],
            'query' => [
                'list_id' => '141965745'
            ]
        ]);

        echo '<pre>';

        foreach (json_decode($lists->getBody()->getContents()) as $list) {
            echo 'LIST: ' . $list->id . "\n";
            $tasksPerList = json_decode($client->get('/api/v1/tasks', [
                'query' => [
                    'list_id' => $list->id
                ]
            ])->getBody()->getContents());
            foreach ($tasksPerList as $taskPerList) {
                echo $taskPerList->id . " - " . $taskPerList->title ."\n";
            }
            echo "\n\n";
        }

        die('3');
    }
}
