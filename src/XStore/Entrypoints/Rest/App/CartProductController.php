<?php

use XStore\Adapters\Rest\Controller;
use XStore\X\Response\HttpResponse;
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\ValidatorException;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;
use XStore\Domains\Commands\AddProductToCartCommand;
use XStore\Views;
use XStore\Domains\Commands\DeleteCartProductCommand;
use XStore\Domains\Commands\UpdateCartProductCommand;

class CartProductController extends Controller
{
    public function executePost()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $validator = Validator::key("user_id", Validator::intType()->notEmpty())
            ->key("property_id", Validator::intType()->notEmpty())
            ->key("number", Validator::intType()->notEmpty());
        try {
            $validator->assert($body);
            $user_id = $body['user_id'];
            $property_id = $body['property_id'];
            $number = $body['number'];
            try {
                $this->bus->handle(new AddProductToCartCommand($user_id, $property_id, $number));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson(data: array())
                );
            } catch (Exception $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::INTERNAL_SERVER_ERROR)->json(
                    new HttpResponseJson(success: false, message: "internal server error")
                );
            }
        } catch (ValidatorException $e) {
            $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                new HttpResponseJson(success: false, message: $e->getMessages())
            );
        }
        $response->build();
    }

    public function executeGet()
    {
        $response = new HttpResponse();
        $user_id = $_GET['user_id'];
        $response->statusCode(HttpStatusCode::OK)->json(
            new HttpResponseJson(data: Views::getCartProductByUserId($this->bus->getUow(), $user_id))
        );
    }

    public function executeDelete()
    {
        $response = new HttpResponse();
        $user_id = $_GET['user_id'];
        $order_property_id = $_GET['order_property_id'];
        try {
            $this->bus->handle(new DeleteCartProductCommand($user_id, $order_property_id));
            $response->statusCode(HttpStatusCode::OK)->json(
                new HttpResponseJson(data: array())
            );
        } catch (Exception $e) {
            error_log($e, LOG_INFO);
            $response->statusCode(HttpStatusCode::INTERNAL_SERVER_ERROR)->json(
                new HttpResponseJson(success: false, message: "internal server error")
            );
        }
    }

    public function executePut()
    {
        $response = new HttpResponse();
        $user_id = $_GET['user_id'];
        $order_property_id = $_GET['order_property_id'];
        $property_id = $_GET['property_id'];
        $number = $_GET['number'];
        try {
            $this->bus->handle(new UpdateCartProductCommand($user_id, $order_property_id, $number, $property_id));
            $response->statusCode(HttpStatusCode::OK)->json(
                new HttpResponseJson(data: array())
            );
        } catch (Exception $e) {
            error_log($e, LOG_INFO);
            $response->statusCode(HttpStatusCode::INTERNAL_SERVER_ERROR)->json(
                new HttpResponseJson(success: false, message: "internal server error")
            );
        }
    }
}

$controller = new CartProductController();
$controller->execute();
