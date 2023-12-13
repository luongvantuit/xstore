<?php


namespace XStore\Adapters\Rest;

use XStore\ServiceLayers\MessageBus;
use XStore\X\Request\Method;
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

    private function _execute()
    {
        $response = new HttpResponse();
        $response->statusCode(HttpStatusCode::NOT_FOUND)->json(
            new HttpResponseJson(message: "not found")
        )->build();
    }

    public function execute()
    {
        switch ($_SERVER[Method::PARAM_NAME]) {
            case Method::GET:
                $this->execute_get();
                break;
            case Method::POST:
                $this->execute_post();
                break;
            case Method::PUT:
                $this->execute_put();
                break;
            case Method::DELETE:
                $this->execute_delete();
                break;
            default:
                $this->_execute();
                break;
        }
    }

    public function execute_get()
    {
        $this->_execute();
    }

    public function execute_post()
    {
        $this->_execute();
    }

    public function execute_put()
    {
        $this->_execute();
    }

    public function execute_delete()
    {
        $this->_execute();
    }
}
