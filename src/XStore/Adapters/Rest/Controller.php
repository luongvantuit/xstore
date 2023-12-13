<?php


namespace XStore\Adapters\Rest;

use XStore\ServiceLayers\MessageBus;

use function XStore\bootstrap;

require_once __DIR__ . "../../../Bootstrap.php";

class Controller
{

    protected MessageBus $bus;

    public function __construct()
    {
        $this->bus = bootstrap();
    }

    private function execute_default()
    {
        header("Content-Type: application/json");
        http_response_code(404);
        echo json_encode(array(
            "error" => "Not found"
        ));
    }

    public function execute()
    {
        $request_method = $_SERVER["REQUEST_METHOD"];
        switch ($request_method) {
            case "GET":
                $this->execute_get();
                break;
            case "POST":
                $this->execute_post();
                break;
            case "PUT":
                $this->execute_put();
                break;
            case "DELETE":
                $this->execute_delete();
                break;
            default:
                $this->execute_default();
                break;
        }
    }

    public function execute_get()
    {
        $this->execute_default();
    }

    public function execute_post()
    {
        $this->execute_default();
    }

    public function execute_put()
    {
        $this->execute_default();
    }

    public function execute_delete()
    {
        $this->execute_default();
    }
}
