<?php


namespace XStore\Adapters\Rest;

use XStore\ServiceLayers\MessageBus;
use XStore\X\Request\HttpRequestMethod;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;

use function XStore\bootstrap;

require_once __DIR__ . "../../../Bootstrap.php";

class Controller
{

    protected MessageBus $bus;

    public function __construct()
    {
        $this->bus = bootstrap();
    }

    private function methodNotAllowed()
    {
        $response = new HttpResponse();
        $response->statusCode(HttpStatusCode::METHOD_NOT_ALLOWED)->json(
            new HttpResponseJson(success: false, message: "method not allowed!")
        )->build();
    }
    private function forbidden()
    {
        $response = new HttpResponse();
        $response->statusCode(HttpStatusCode::FORBIDDEN)->json(
            new HttpResponseJson(success: false, message: "forbidden!")
        )->build();
    }

    public function execute()
    {
        switch ($_SERVER[HttpRequestMethod::PARAM_NAME]) {
            case HttpRequestMethod::GET:
                $this->executeGet();
                break;
            case HttpRequestMethod::POST:
                $this->executePost();
                break;
            case HttpRequestMethod::PUT:
                $this->executePut();
                break;
            case HttpRequestMethod::DELETE:
                $this->executeDelete();
                break;
            default:
                $this->forbidden();
                break;
        }
    }

    public function executeGet()
    {
        $this->methodNotAllowed();
    }

    public function executePost()
    {
        $this->methodNotAllowed();
    }

    public function executePut()
    {
        $this->methodNotAllowed();
    }

    public function executeDelete()
    {
        $this->methodNotAllowed();
    }
}
