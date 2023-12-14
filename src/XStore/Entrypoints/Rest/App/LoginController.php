<?php

use XStore\Adapters\Rest\Controller;
use XStore\Domains\Commands\LoginCommand;
use XStore\Domains\Commands\UserLoginCommand;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\ServiceLayers\Exceptions\InvalidPasswordException;
use XStore\Views;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;

require_once __DIR__ . "/../../../ServiceLayers/Utils.php";
require_once __DIR__ . "../../../../Views.php";

class LoginController extends Controller
{

    public function execute_post()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $email = $body['email'];
        $password = $body['password'];
        $response = new HttpResponse();
        try {
            $this->bus->handle(new UserLoginCommand($email, $password));
            $user = Views::get_user_by_email($this->bus->get_uow(), $email);
            $response->statusCode(HttpStatusCode::OK)->json(
                new HttpResponseJson(data: array(
                    "user" => $user,
                    // "jwt" => generateJWT($user)
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
        $response->build();
    }
}

$controller = new LoginController();
$controller->execute();
