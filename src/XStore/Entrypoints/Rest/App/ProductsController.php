<?php

use XStore\Adapters\Rest\Controller;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;
use XStore\Views;

class ProductsController extends Controller
{
    public function executeGet()
    {
        $response = new HttpResponse();

        $response->statusCode(HttpStatusCode::OK)->json(
            new HttpResponseJson(data: Views::getProducts($this->bus->getUow()))
        );
        $response->build();
    }
}

$controller = new ProductsController();
$controller->execute();
