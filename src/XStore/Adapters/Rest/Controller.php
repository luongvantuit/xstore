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

    private function method_not_allowed()
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
                $this->execute_get();
                break;
            case HttpRequestMethod::POST:
                $this->execute_post();
                break;
            case HttpRequestMethod::PUT:
                $this->execute_put();
                break;
            case HttpRequestMethod::DELETE:
                $this->execute_delete();
                break;
            default:
                $this->forbidden();
                break;
        }
    }

    public function execute_get()
    {
        $this->method_not_allowed();
    }

    public function execute_post()
    {
        $this->method_not_allowed();
    }

    public function execute_put()
    {
        $this->method_not_allowed();
    }

    public function execute_delete()
    {
        $this->method_not_allowed();
    }
}
