<?php

use Respect\Validation\Exceptions\ValidatorException;
use Respect\Validation\Validator;
use XStore\Adapters\Rest\Controller;
use XStore\Domains\Commands\CreateNewAdminCommand;
use XStore\Domains\Commands\RemoveAdminCommand;
use XStore\Domains\Commands\UpdateAdminCommand;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\ServiceLayers\Exceptions\UsernameExistedException;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;

class AdminController extends Controller
{

    public function executeGet()
    {
        // Get admin
    }

    public function executePost()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $validator = Validator::key("username", Validator::stringType()->notEmpty()->length(6, 24))
            ->key("email", Validator::email(), false)
            ->key("password", Validator::stringType()->notEmpty());
        try {
            $validator->assert($body);
            $username = $body['username'];
            /**
             * @var string|null $email
             */
            $email = $body['email'] ?? null;
            $password = $body['password'];
            try {
                $this->bus->handle(new CreateNewAdminCommand(
                    username: $username,
                    email: $email,
                    password: $password
                ));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson()
                );
            } catch (UsernameExistedException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                    new HttpResponseJson(success: false, message: $e->getMessage())
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
        // Create new admin
    }

    public function executePut()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $validator = Validator::key("id", Validator::intType()->notEmpty())
            ->key("username", Validator::stringType()->length(6, 24), false)
            ->key("email", Validator::stringType(), false);
        try {
            $validator->assert($body);
            $adminId = $body['id'];
            $username = $body['username'] ?? null;
            $email = $body['email'] ?? null;
            try {
                $this->bus->handle(new UpdateAdminCommand(
                    adminId: $adminId,
                    username: $username,
                    email: $email
                ));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson()
                );
            } catch (NotFoundException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                    new HttpResponseJson(success: false, message: "not found admin!")
                );
            } catch (UsernameExistedException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                    new HttpResponseJson(success: false, message: $e->getMessage())
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
        // Update a admin
    }

    public function executeDelete()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $validator = Validator::key("id", Validator::intType()->notEmpty());
        try {
            $validator->assert($body);
            $adminId = $body['id'];
            try {
                $this->bus->handle(new RemoveAdminCommand(adminId: $adminId));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson()
                );
            } catch (NotFoundException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                    new HttpResponseJson(success: false, message: "not found admin!")
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

$controller = new AdminController();
$controller->execute();
