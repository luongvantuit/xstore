<?php

use XStore\Adapters\Rest\Controller;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;
use XStore\Views;
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\ValidatorException;
use XStore\Domains\Commands\CreateOrderCommand;
use XStore\Configs;
use XStore\X\Jw\Exceptions\InvalidTokenException;
use XStore\X\Jw\Jwt;
use XStore\Domains\Commands\UpdateOrderCommand;
use XStore\ServiceLayers\Exceptions\ForbiddenException;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\Domains\Commands\CancelOrderCommand;
use XStore\ServiceLayers\Exceptions\OutStockException;

class OrdersController extends Controller
{
    public function executeGet()
    {
        $response = new HttpResponse();
        $header = getallheaders();
        $jwt = $header['Authorization'];
        $jwt = substr($jwt, 7);
        try {
            $user_id = Views::getUserIdByJwt($this->bus->getUow(), new Jwt(Configs::getSecretKey()), $jwt);
            $response->statusCode(HttpStatusCode::OK)->json(
                new HttpResponseJson(data: Views::getOrdersByUserId($this->bus->getUow(), $user_id))
            );
        } catch (InvalidTokenException $e) {
            $response->statusCode(HttpStatusCode::UNAUTHORIZED)->json(
                new HttpResponseJson(success: false, message: "invalid token!")
            );
        }

        $response->build();
    }

    public function executePost()
    {
        $response = new HttpResponse();
        $body = json_decode(file_get_contents('php://input'), true);
        $header = getallheaders();
        $jwt = $header['Authorization'];
        $jwt = substr($jwt, 7);
        try {
            $user_id = Views::getUserIdByJwt($this->bus->getUow(), new Jwt(Configs::getSecretKey()), $jwt);
            $validator = Validator::key("address_id", Validator::intType()->notEmpty())
                ->key(
                    "products",
                    Validator::each(Validator::key("property_id", Validator::intType()->notEmpty())
                        ->key("number", Validator::intType()->notEmpty()))
                )->notEmpty();
            try {
                $validator->assert($body);
                $address_id = $body['address_id'];
                $products = $body['products'];
                try {
                    $this->bus->handle(new CreateOrderCommand($user_id, $address_id, $products));
                    $response->statusCode(HttpStatusCode::OK)->json(
                        new HttpResponseJson(data: array())
                    );
                } catch (OutStockException $e) {
                    $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                        new HttpResponseJson(success: false, message: $e->getMessage())
                    );
                } catch (Exception $e) {
                    $response->statusCode(HttpStatusCode::INTERNAL_SERVER_ERROR)->json(
                        new HttpResponseJson(success: false, message: "internal server error")
                    );
                }
            } catch (ValidatorException $e) {
                $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                    new HttpResponseJson(success: false, message: $e->getMessages())
                );
            }
        } catch (InvalidTokenException $e) {
            $response->statusCode(HttpStatusCode::UNAUTHORIZED)->json(
                new HttpResponseJson(success: false, message: "invalid token!")
            );
        }
        $response->build();
    }

    public function executePut()
    {
        $response = new HttpResponse();
        $header = getallheaders();
        $jwt = $header['Authorization'];
        $jwt = substr($jwt, 7);
        try {
            $user_id = Views::getUserIdByJwt($this->bus->getUow(), new Jwt(Configs::getSecretKey()), $jwt);
            $address_id = $_GET['address_id'];
            $order_id = $_GET['order_id'];
            try {
                $this->bus->handle(new UpdateOrderCommand($user_id, $order_id, $address_id,));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson(data: array())
                );
            } catch (NotFoundException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::NOT_FOUND)->json(
                    new HttpResponseJson(success: false, message: "not found!")
                );
            } catch (ForbiddenException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::FORBIDDEN)->json(
                    new HttpResponseJson(success: false, message: "forbidden!")
                );
            } catch (Exception $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::INTERNAL_SERVER_ERROR)->json(
                    new HttpResponseJson(success: false, message: "internal server error")
                );
            }
        } catch (InvalidTokenException $e) {
            $response->statusCode(HttpStatusCode::UNAUTHORIZED)->json(
                new HttpResponseJson(success: false, message: "invalid token!")
            );
        }
        $response->build();
    }

    public function executeDelete()
    {
        $response = new HttpResponse();
        $header = getallheaders();
        $jwt = $header['Authorization'];
        $jwt = substr($jwt, 7);
        try {
            $user_id = Views::getUserIdByJwt($this->bus->getUow(), new Jwt(Configs::getSecretKey()), $jwt);
            $order_id = $_GET['order_id'];
            try {
                $this->bus->handle(new CancelOrderCommand($user_id, $order_id));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson(data: array())
                );
            } catch (NotFoundException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::NOT_FOUND)->json(
                    new HttpResponseJson(success: false, message: "not found!")
                );
            } catch (ForbiddenException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::FORBIDDEN)->json(
                    new HttpResponseJson(success: false, message: "forbidden!")
                );
            } catch (Exception $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::INTERNAL_SERVER_ERROR)->json(
                    new HttpResponseJson(success: false, message: "internal server error")
                );
            }
        } catch (InvalidTokenException $e) {
            $response->statusCode(HttpStatusCode::UNAUTHORIZED)->json(
                new HttpResponseJson(success: false, message: "invalid token!")
            );
        }
        $response->build();
    }
}

$controller = new OrdersController();
$controller->execute();
