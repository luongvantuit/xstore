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
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\ServiceLayers\Exceptions\OutStockException;
use XStore\Configs;
use XStore\X\Jw\Exceptions\InvalidTokenException;
use XStore\X\Jw\Jwt;

class CartProductController extends Controller
{
    public function executePost()
    {
        $response = new HttpResponse();
        $header = getallheaders();
        $jwt = $header['Authorization'];
        $jwt = substr($jwt, 7);
        try {
            $user_id = Views::getUserIdByJwt($this->bus->getUow(), new Jwt(Configs::getSecretKey()), $jwt);
            $body = json_decode(file_get_contents('php://input'), true);
            $validator = Validator::key("property_id", Validator::intType()->notEmpty())
                ->key("number", Validator::intType()->notEmpty());
            try {
                $validator->assert($body);
                $property_id = $body['property_id'];
                $number = $body['number'];
                error_log($property_id, LOG_INFO);
                error_log($number, LOG_INFO);
                error_log($user_id, LOG_INFO);
                try {
                    $this->bus->handle(new AddProductToCartCommand($user_id, $property_id, $number));
                    $response->statusCode(HttpStatusCode::OK)->json(
                        new HttpResponseJson(data: array())
                    );
                } catch (NotFoundException $e) {
                    error_log($e, LOG_INFO);
                    $response->statusCode(HttpStatusCode::NOT_FOUND)->json(
                        new HttpResponseJson(success: false, message: "not found!")
                    );
                } catch (OutStockException $e) {
                    error_log($e, LOG_INFO);
                    $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                        new HttpResponseJson(success: false, message: "out stock!")
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
        } catch (InvalidTokenException $e) {
            error_log($e, LOG_INFO);
            $response->statusCode(HttpStatusCode::FORBIDDEN)->json(
                new HttpResponseJson(success: false, message: $e->getMessage())
            );
        }
        $response->build();
    }

    public function executeGet()
    {
        $response = new HttpResponse();
        $header = getallheaders();
        $jwt = $header['Authorization'];
        $jwt = substr($jwt, 7);
        try {
            $user_id = Views::getUserIdByJwt($this->bus->getUow(), new Jwt(Configs::getSecretKey()), $jwt);
            $response->statusCode(HttpStatusCode::OK)->json(
                new HttpResponseJson(data: Views::getCartProductByUserId($this->bus->getUow(), $user_id))
            );
        } catch (InvalidTokenException $e) {
            error_log($e, LOG_INFO);
            $response->statusCode(HttpStatusCode::FORBIDDEN)->json(
                new HttpResponseJson(success: false, message: $e->getMessage())
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
            $property_id = $_GET['property_id'];
            try {
                $this->bus->handle(new DeleteCartProductCommand($user_id, $property_id));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson(data: array())
                );
            } catch (NotFoundException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::NOT_FOUND)->json(
                    new HttpResponseJson(success: false, message: "not found!")
                );
            } catch (Exception $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::INTERNAL_SERVER_ERROR)->json(
                    new HttpResponseJson(success: false, message: "internal server error")
                );
            }
        } catch (InvalidTokenException $e) {
            error_log($e, LOG_INFO);
            $response->statusCode(HttpStatusCode::FORBIDDEN)->json(
                new HttpResponseJson(success: false, message: $e->getMessage())
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
            $property_id = $_GET['property_id'];
            $number = $_GET['number'];
            try {
                $this->bus->handle(new UpdateCartProductCommand($user_id, $property_id, $number));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson(data: array())
                );
            } catch (NotFoundException $e) {
                $response->statusCode(HttpStatusCode::NOT_FOUND)->json(
                    new HttpResponseJson(success: false, message: "not found!")
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
        } catch (InvalidTokenException $e) {
            $response->statusCode(HttpStatusCode::FORBIDDEN)->json(
                new HttpResponseJson(success: false, message: $e->getMessage())
            );
        }
        $response->build();
    }
}

$controller = new CartProductController();
$controller->execute();
