<?php

use Respect\Validation\Exceptions\ValidatorException;
use Respect\Validation\Validator;
use XStore\Adapters\Rest\Controller;
use XStore\Domains\Commands\InitialAdminCommand;
use XStore\ServiceLayers\Exceptions\RootWasInitiatedException;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;

class InitialRootPasswordController extends Controller
{

    public function executeGet()
    {
        // Get admin
    }

    public function executePost()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $validator = Validator::key("password", Validator::stringType()->notEmpty()->length(6, null));
        try {
            $validator->assert($body);
            $password = $body['password'];
            try {
                $this->bus->handle(new InitialAdminCommand($password));
            } catch (RootWasInitiatedException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::INTERNAL_SERVER_ERROR)->json(
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
    }
}

$controller = new InitialRootPasswordController();
$controller->execute();
