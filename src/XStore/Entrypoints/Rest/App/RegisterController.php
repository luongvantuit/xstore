<?php

use Respect\Validation\Exceptions\ValidatorException;
use Respect\Validation\Validator;
use XStore\Adapters\Rest\Controller;
use XStore\Domains\Commands\CreateNewUserCommand;
use XStore\ServiceLayers\Exceptions\EmailExistedException;
use XStore\ServiceLayers\Exceptions\UsernameExistedException;
use XStore\Views;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;

class RegisterController extends Controller
{
    public function execute_post()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $validator = Validator::key("username", Validator::stringType()->notEmpty()->length(6, 24))
            ->key("email", Validator::email())
            ->key("password", Validator::stringType()->notEmpty());
        try {
            $validator->assert($body);
            $username = $body['username'];
            $email = $body['email'];
            $password = $body['password'];
            try {
                $this->bus->handle(new CreateNewUserCommand(username: $username, email: $email, password: $password));
                $user = Views::get_user_by_email($this->bus->get_uow(), $email);
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson(data: $user)
                );
            } catch (UsernameExistedException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                    new HttpResponseJson(success: false, message: $e->getMessage())
                );
            } catch (EmailExistedException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                    new HttpResponseJson(success: false, message: $e->getMessage())
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

$controller = new RegisterController();
$controller->execute();
