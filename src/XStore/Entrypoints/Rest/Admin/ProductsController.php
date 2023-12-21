<?php

use Respect\Validation\Exceptions\ValidatorException;
use Respect\Validation\Validator;
use XStore\Adapters\Rest\Controller;
use XStore\Domains\Commands\CreateNewProductCommand;
use XStore\Domains\Commands\DeleteProductCommand;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;

class ProductsController extends Controller
{

    public function executePost()
    {
        $response = new HttpResponse();
        $validator = Validator::key("name", Validator::stringType()->notEmpty())
            ->key("description", Validator::stringType(), false);
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . "/../../../../../public/static/";
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $tempFile = $_FILES['file']['tmp_name'];
            $md5_hash = md5_file($tempFile);
            $destination = $uploadDir . $md5_hash . "." . pathinfo($_FILES['file']["name"], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['file']['tmp_name'], $destination);
            error_log($md5_hash, LOG_INFO);
            try {
                $validator->assert($_POST);
                $name = $_POST['name'];
                /**
                 * @var string|null $description
                 */
                $description = $_POST['description'] ?? null;
                try {
                    $this->bus->handle(new CreateNewProductCommand(
                        name: $name,
                        description: $description,
                        path: "/static/" . $md5_hash . "." . pathinfo($_FILES['file']["name"], PATHINFO_EXTENSION),
                    ));
                    $response->statusCode(HttpStatusCode::OK)->json(
                        new HttpResponseJson()
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
        } else {
            $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                new HttpResponseJson(success: false, message: "error upload file!")
            );
        }
        $response->build();
    }

    public function executeDelete()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $validator = Validator::key("id", Validator::intType()->notEmpty());
        try {
            $validator->assert($body);
            $productId = $body['id'];
            try {
                $this->bus->handle(new DeleteProductCommand(productId: $productId));
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

$controller = new ProductsController();
$controller->execute();