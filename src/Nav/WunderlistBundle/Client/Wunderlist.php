<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 15-05-16
 * Time: 16:34
 */

namespace Nav\WunderlistBundle\Client;


use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class Wunderlist
{
    protected $container;
    protected $client;
    protected $access_url;

    public function __construct(Container $containerAware)
    {
        $this->access_url = $containerAware->getParameter('wunderlist.baseurl') . 'oauth/access_token';
        $this->container = $containerAware;
    }

    public function getAuthorization()
    {
        $authUrl = 'https://www.wunderlist.com/oauth/authorize?' .
            'client_id=' . $this->container->getParameter('wunderlist.clientid'). '&' .
            'redirect_uri=' . $this->container->get('request_stack')->getCurrentRequest()->getUriForPath('/callback') .
            '&state=RANDOM
        ';
            
        return new RedirectResponse($authUrl);
    }

    public function getAccessToken(Request $request)
    {
        $code = $request->get('code', false);
        
        if(!is_null($code)){
            $client = new Client([
                'base_uri' => 'https://www.wunderlist.com/'
            ]);
            $accessResponse = $client->request('POST', '/oauth/access_token', [
                'json' => [
                    'client_id' => $this->container->getParameter('wunderlist.clientid'),
                    'client_secret' => $this->container->getParameter('wunderlist.clientsecret'),
                    'code' => $code,
                ],
                'verify' => false
            ])->getBody()->getContents();

            $access = json_decode($accessResponse);

            if(isset($access->access_token)){
                $this->client = new Client([
                    'base_uri' => 'https://a.wunderlist.com',
                    'headers' => [
                        'X-Access-Token' => $access->access_token,
                        'X-Client-ID'     => $this->container->getParameter('wunderlist.clientid')
                    ],
                    'verify' => false
                ]);
            }

        } else{
            return $this->redirectToRoute('wunderlist');
        }
    }

    public function getClient()
    {
        return $this->client;
    }


}