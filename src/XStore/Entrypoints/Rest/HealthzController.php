<?php

use XStore\Adapters\Rest\Controller;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;


class HealthzController extends Controller
{

    public function executeGet(): void
    {
        $response = new HttpResponse();
        $response->statusCode(HttpStatusCode::OK)->json(
            new HttpResponseJson(message: "alive!")
        )->build();
    }
}


$controller = new HealthzController();
$controller->execute();
