<?php

use Respect\Validation\Exceptions\ValidatorException;
use Respect\Validation\Validator;
use XStore\Adapters\Rest\Controller;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;

class AdminController extends Controller
{

    public function execute_get()
    {
        // Get admin
    }

    public function execute_post()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $validator = Validator::key("username", Validator::stringType()->notEmpty()->length(6, 24))
            ->key("email", Validator::nullable(Validator::email()))
            ->key("password", Validator::stringType()->notEmpty());
        try {
            $validator->assert($body);
            $username = $body['username'];
            $email = $body['email'];
            $password = $body['password'];
        } catch (ValidatorException $e) {
            $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                new HttpResponseJson(success: false, message: $e->getMessages())
            );
        }
        $response->build();
        // Create new admin
    }

    public function execute_put()
    {
        // Update a admin
    }

    public function execute_delete()
    {
        // Delete a admin
    }
}

$controller = new AdminController();
$controller->execute();
