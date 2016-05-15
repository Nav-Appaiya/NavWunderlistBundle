<?php

namespace AppBundle\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Nav\WunderlistBundle\Client\WunderlistList;
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

            // Wunderlist
            $wlHelper = $this->get('nav_wunderlist.client');
            $wlHelper->getAccessToken($request);
            $client = $wlHelper->getClient();

            // API list Resources
            $lists = json_decode($client->get('/api/v1/lists')->getBody()->getContents());

            $savedLists = array();
            foreach ($lists as $wlListResource) {
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
                $em->flush();
                $savedLists[] = $wlListResource->title;
            }


            foreach ($savedLists as $savedList) {
                echo 'saved lists: ' . $savedList . "<br />";
            }
            exit;
        }else{
            return $this->redirectToRoute('wunderlist');
        }
    }

    /**
     * The callback url where we will be send after
     * wunderlist authorizes us for access on the user resource.
     *
     * @Route("/tasks", name="wunderlist_tasks")
     */
    public function tasksAction(Request $request)
    {
        // TODO: Tasks per list
        // Using wunderlistTasks service
        // Create tasks
        // Update tasks
        // Delete tasks
        die('Wunderlist Tasks');
    }
}
