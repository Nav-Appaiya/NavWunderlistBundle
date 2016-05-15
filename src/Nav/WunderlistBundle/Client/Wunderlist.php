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
        $this->access_url = 'https://www.wunderlist.com/oauth/access_token';
        $this->container = $containerAware;
        $this->client = new Client();
    }

    public function getAuthorization()
    {
        $authUrl = 'https://www.wunderlist.com/oauth/authorize?' .
            'client_id=21f6e505604ffff759c4&' .
            'redirect_uri=' . $this->container->get('request_stack')->getCurrentRequest()->getUriForPath('/callback') .
            '&state=RANDOM
        ';
            
        return new RedirectResponse($authUrl);
    }

    public function getAccessToken(Request $request)
    {
        $code = $request->get('code', null);
        if(!is_null($code)){
            $client = new Client([
                'base_uri' => 'https://www.wunderlist.com/'
            ]);
            $accessResponse = $client->request('POST', '/oauth/access_token', ['json' => [
                'client_id' => '21f6e505604ffff759c4',
                'client_secret' => '50d39412458c1c30fd3fe9f00f9eb0ddd76732618ede7fc5036ec60b3860',
                'code' => $code,
            ]])->getBody()->getContents();

            $access = json_decode($accessResponse);

            if(isset($access->access_token)){
                $this->client = new Client([
                    'base_uri' => 'https://a.wunderlist.com',
                    'headers' => [
                        'X-Access-Token' => $access->access_token,
                        'X-Client-ID'     => '21f6e505604ffff759c4'
                    ]
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