<?php

use XStore\Adapters\Rest\Controller;
use XStore\Domains\Commands\LoginCommand;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\ServiceLayers\Exceptions\InvalidPasswordException;

use function XStore\get_user_by_email;
use function XStore\ServiceLayers\generateJWT;

require_once __DIR__ . "/../../../ServiceLayers/Utils.php";
require_once __DIR__ . "../../../../Views.php";

class AuthController extends Controller
{

    public function execute_post()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $email = $body['email'];
        $password = $body['password'];
        header("Content-Type: application/json");
        try {
            $this->bus->handle(new LoginCommand($email, $password));
            $user = get_user_by_email($this->bus->get_uow(), $email);
            http_response_code(200);
            echo json_encode(array(
                "message" => "Login success",
                "user" => $user,
                "jwt" => generateJWT($user)
            ));
        } catch (NotFoundException $e) {
            http_response_code(404);
            echo json_encode(array(
                "error" => "Not found user"
            ));
            return;
        } catch (InvalidPasswordException $e) {
            http_response_code(401);
            echo json_encode(array(
                "error" => "Invalid password"
            ));
            return;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(array(
                "error" => "Internal server error"
            ));
            return;
        }
    }
}

$controller = new AuthController();
$controller->execute();
