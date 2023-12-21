<?php

use Respect\Validation\Exceptions\ValidatorException;
use Respect\Validation\Validator;
use XStore\Adapters\Rest\Controller;
use XStore\Domains\Commands\AdminUpdateOrderCommand;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;

class OrdersController extends Controller
{

    public function executePut()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $validator = Validator::key("id", Validator::intType()->notEmpty())
            ->key("status", Validator::stringType()->notEmpty());
        try {
            $validator->assert($body);
            $orderId = $body['id'];
            $status = $body['status'];
            error_log($status, LOG_INFO);
            try {
                $this->bus->handle(new AdminUpdateOrderCommand($orderId, $status));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson()
                );
            } catch (NotFoundException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                    new HttpResponseJson(success: false, message: "not found order!")
                );
            } catch (Exception $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::INTERNAL_SERVER_ERROR)->json(
                    new HttpResponseJson(success: false, message: "internal server error!")
                );
            }
        } catch (ValidatorException $e) {
            $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                new HttpResponseJson(success: false, message: $e->getMessages())
            );
        }
        $response->build();
    }
}

$controller = new OrdersController();
$controller->execute();
