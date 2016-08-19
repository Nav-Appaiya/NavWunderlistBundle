<?php

namespace AppBundle\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Nav\WunderlistBundle\Client\WunderlistList;
use Nav\WunderlistBundle\Entity\WunderlistAccount;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class WunderlistController extends Controller
{

    /**
     * Redirects to the login page for getting our
     * app authorized for wunderlist.
     * 
     * @Route("/", name="wunderlist_index")
     */
    public function indexAction(Request $request)
    {
        $wlHelper = $this->get('nav_wunderlist.client');

        return $wlHelper->getAuthorization();
    }

    /**
     * The callback url where we will be send after
     * wunderlist authorizes us for access on the user resource.
     * 
     * @Route("/callback", name="wunderlist_callback")
     */
    public function callbackAction(Request $request)
    {
        if($request->get('code')){
            echo 'Successfully authed, lets save your lists first' . "<br /><br />";

            // Doctrine
            $em = $this->get('doctrine.orm.entity_manager');
            $listRepo = $em->getRepository('NavWunderlistBundle:WunderlistList');
            $accountRepo = $em->getRepository('NavWunderlistBundle:WunderlistAccount');

            // Wunderlist
            $wlHelper = $this->get('nav_wunderlist.client');
            $wlHelper->getAccessToken($request);
            $client = $wlHelper->getClient();

            // API list Resources
            $lists = json_decode($client->get('/api/v1/lists')->getBody()->getContents());
            $account = json_decode($client->get('/api/v1/user')->getBody()->getContents());

            $user = $accountRepo->findOneBy([
                'accountId' => $account->id
            ]);

            if (!$user) {
                $user = new WunderlistAccount();
                $user->setAccountId($account->id);
            }
            $user->setName($account->name);
            $user->setEmail($account->email);
            $user->setRevision($account->revision);
            $user->setCreatedAt(new \DateTime());
            $user->setAccessToken($request->get('code'));
            $user->setUsername($this->getParameter('wunderlist.clientid'));
            $user->setPasssword($this->getParameter('wunderlist.clientsecret'));
            $user->setClientId($this->getParameter('wunderlist.clientid'));
            $em->persist($user);
            $em->flush();

            $savedLists = array();
            foreach ($lists as $wlListResource) {
                $userId = $wlListResource->owner_id;

                $list = $listRepo->findOneBy([
                    'wunderlistId' => $wlListResource->id
                ]);

                if (!$list) {
                    $list = new \Nav\WunderlistBundle\Entity\WunderlistList();
                }

                $list->setWunderlistId($wlListResource->id);
                $list->setTitle($wlListResource->title);
                $list->setOwnerType($wlListResource->owner_type);
                $list->setOwnerId($wlListResource->owner_id);
                $list->setListType($wlListResource->list_type);
                $list->setPublic($wlListResource->public);
                $list->setCreatedAt(new \DateTime($wlListResource->created_at));
                $list->setRevision($wlListResource->revision);
                $list->setType($wlListResource->type);

                $em->persist($list);
                $savedLists[] = $wlListResource->title;
            }

            $em->flush();
        }else{
            return $this->redirectToRoute('wunderlist');
        }

        return $this->render('@NavWunderlist/Default/landing.html.twig', [
            'savedLists' => $savedLists,
            'user' => $user
        ]);
    }

    /**
     * Displaying tasks for authed user.
     *
     * @Route("/tasks", name="wunderlist_tasks")
     */
    public function tasksAction(Request $request)
    {
        // Display Local tasks
        $em = $this->getDoctrine()->getEntityManager();
        $taskRepo = $em->getRepository('NavWunderlistBundle:WunderlistTask');

        return $this->render('@NavWunderlist/Default/tasks.html.twig', [
            'tasks' => $taskRepo->findAll()
        ]);
    }
}
