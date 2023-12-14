<?php

use XStore\Adapters\Rest\Controller;
use XStore\X\Response\HttpResponse;

class RegisterController extends Controller
{
    public function execute_post()
    {
        $response = new HttpResponse();

        $response->build();
    }
}


$controller = new RegisterController();
$controller->execute();
