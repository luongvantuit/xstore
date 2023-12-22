<?php

use XStore\Adapters\Rest\Controller;
use XStore\X\Response\HttpResponse;
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\ValidatorException;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;
use XStore\Views;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\Configs;
use XStore\X\Jw\Exceptions\InvalidTokenException;
use XStore\X\Jw\Jwt;
use XStore\Domains\Commands\AddAddressCommand;
use XStore\Domains\Commands\DeleteAddressCommand;
use XStore\Domains\Commands\UpdateAddressCommand;

class AddressController extends Controller
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
            $validator = Validator::key("first_name", Validator::stringType()->notEmpty())
                ->key("last_name", Validator::stringType()->notEmpty())
                ->key("phone_number", Validator::stringType()->notEmpty())
                ->key("address", Validator::stringType()->notEmpty())
                ->key("email", Validator::stringType()->notEmpty())
                ->key("default_address", Validator::boolType(), false);
            try {
                $validator->assert($body);
                $first_name = $body['first_name'];
                $last_name = $body['last_name'];
                $phone_number = $body['phone_number'];
                $address = $body['address'];
                $email = $body['email'];
                $default_address = $body['default_address'];
                try {
                    $this->bus->handle(new AddAddressCommand(
                        $user_id,
                        $first_name,
                        $last_name,
                        $phone_number,
                        $address,
                        $email,
                        $default_address
                    ));

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
                new HttpResponseJson(data: Views::getAddressByUserId($this->bus->getUow(), $user_id))
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
            $address_id = $_GET['id'];

            try {
                $this->bus->handle(new DeleteAddressCommand(
                    $user_id,
                    $address_id
                ));
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
        } catch (ValidatorException $e) {
            $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                new HttpResponseJson(success: false, message: $e->getMessages())
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
            $body = json_decode(file_get_contents('php://input'), true);
            $validator = Validator::key("id", Validator::intType()->notEmpty());
            try {
                $validator->assert($body);
                $address_id = $body['id'];
                $first_name = isset($body['first_name']) ? $body['first_name'] : null;
                $last_name = isset($body['last_name']) ? $body['last_name'] : null;
                $phone_number = isset($body['phone_number']) ? $body['phone_number'] : null;
                $address = isset($body['address']) ? $body['address'] : null;
                $email = isset($body['email']) ? $body['email'] : null;
                $default_address = isset($body['default_address']) ? $body['default_address'] : null;
                try {
                    $this->bus->handle(new UpdateAddressCommand(
                        $user_id,
                        $address_id,
                        $first_name,
                        $last_name,
                        $phone_number,
                        $address,
                        $email,
                        $default_address
                    ));
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
            } catch (ValidatorException $e) {
                $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                    new HttpResponseJson(success: false, message: $e->getMessages())
                );
            }
        } catch (InvalidTokenException $e) {
            error_log($e, LOG_INFO);
            $response->statusCode(HttpStatusCode::FORBIDDEN)->json(
                new HttpResponseJson(success: false, message: $e)
            );
        }
    }
}

$controller = new AddressController();
$controller->execute();
