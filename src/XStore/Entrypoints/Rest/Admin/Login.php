<?php

use XStore\Adapters\Rest\Controller;
use XStore\Domains\Commands\LoginCommand;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\ServiceLayers\Exceptions\InvalidPasswordException;

class AuthController extends Controller
{

    public function execute_post()
    {
        // $body = json_decode(file_get_contents('php://input'), true);
        // $email = $body['email'];
        // $password = $body['password'];
        // try {
        //     $this->bus->handle(new LoginCommand($email, $password));
        // } catch (NotFoundException $e) {
        //     header("Content-Type: application/json");
        //     http_response_code(404);
        //     echo json_encode(array(
        //         "error" => "Not found user"
        //     ));
        //     return;
        // } catch (InvalidPasswordException $e) {
        //     header("Content-Type: application/json");
        //     http_response_code(401);
        //     echo json_encode(array(
        //         "error" => "Invalid password"
        //     ));
        //     return;
        // } catch (Exception $e) {
        //     header("Content-Type: application/json");
        //     http_response_code(500);
        //     echo json_encode(array(
        //         "error" => "Internal server error"
        //     ));
        //     return;
        // }
        // header("Content-Type: application/json");
        // http_response_code(200);
        // echo json_encode(array(
        //     "message" => "Login success"
        // ));
    }
}

$controller = new AuthController();
$controller->execute();
