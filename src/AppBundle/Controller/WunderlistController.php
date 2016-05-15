<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class WunderlistController extends Controller
{
    public function callbackAction(Request $request)
    {
        echo '<pre>';
        print_r($request);

        exit;
    }
}
