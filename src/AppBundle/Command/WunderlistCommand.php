<?php

namespace AppBundle\Command;

use Nav\WunderlistBundle\Entity\WunderlistTask;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WunderlistCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:wunderlist:fetch')
            ->setDescription('Get all your wunderlist tasks in the db.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $wunderlist = $this->getContainer()->get('nav_wunderlist.tasks');
        $tasks  = $wunderlist->getTasksForListId("141965745");
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $taskRepo = $this->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository('NavWunderlistBundle:WunderlistTask');

        foreach ($tasks as $task) {
            $newTask = $taskRepo->findOneBy([
                'taskId' => $task->id
            ]);

            if(!$newTask){
                $newTask = new WunderlistTask();
                $newTask->setTaskId($task->id);
                echo 'New Task: ' . $task->title . PHP_EOL;
            }
            $newTask->setCreatedAt(new \DateTime($task->created_at));
            $newTask->setRevision($task->revision);
            $newTask->setCompleted($task->completed);
            $newTask->setCreatedById($task->created_by_id);
            $newTask->setCreatedByRequestId($task->created_by_request_id);
            $newTask->setCompleted($task->completed);
            $newTask->setStarred(!!$task->starred);
            $newTask->setListId($task->list_id);
            $newTask->setTitle($task->title);
            $newTask->setType($task->type);
            $em->persist($newTask);
            echo "Fetched: " . $newTask->getTitle() .  PHP_EOL;
        }
        $em->flush();
    }
}
