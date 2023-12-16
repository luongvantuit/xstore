<?php

use Respect\Validation\Exceptions\ValidatorException;
use Respect\Validation\Validator;
use XStore\Adapters\Rest\Controller;
use XStore\Configs;
use XStore\Domains\Commands\UserLoginCommand;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\ServiceLayers\Exceptions\InvalidPasswordException;
use XStore\Views;
use XStore\X\Jw\Jwt;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;

class LoginController extends Controller
{

    public function execute_post()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $validator = Validator::key("identify", Validator::stringType()->notEmpty())
            ->key("password", Validator::stringType()->notEmpty());
        try {
            $validator->assert($body);
            $identify = $body['identify'];
            $password = $body['password'];
            try {
                $this->bus->handle(new UserLoginCommand($identify, $password));
                $user = Views::get_user_by_identify($this->bus->get_uow(), $identify);
                $jwt = Views::get_jwt_token_of_user($this->bus->get_uow(), $user["id"], new Jwt(Configs::get_secret_key()));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson(data: array(
                        "user" => $user,
                        "jwt" => $jwt
                    ))
                );
            } catch (NotFoundException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::NOT_FOUND)->json(
                    new HttpResponseJson(success: false, message: "not found user")
                );
            } catch (InvalidPasswordException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::UNAUTHORIZED)->json(
                    new HttpResponseJson(success: false, message: "invalid password")
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
}

$controller = new LoginController();
$controller->execute();
