<?php

use Respect\Validation\Exceptions\ValidatorException;
use Respect\Validation\Validator;
use XStore\Adapters\Rest\Controller;
use XStore\Domains\Commands\CreateNewPropertyCommand;
use XStore\Domains\Commands\DeletePropertyCommand;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;

class PropertiesController extends Controller
{

    public function executeGet()
    {
    }

    public function executePost()
    {
        $response = new HttpResponse();
        // $validator = Validator::key("product_id", Validator::intType()->notEmpty())
        //     ->key("number", Validator::intType()->notEmpty())
        //     ->key("color", Validator::intType()->notEmpty())
        //     ->key("size_id", Validator::intType()->notEmpty())
        //     ->key("price", Validator::floatType()->notEmpty());
        $path = null;
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
            $path =  "/static/" . $md5_hash . "." . pathinfo($_FILES['file']["name"], PATHINFO_EXTENSION);
        }
        try {
            // $validator->assert($_POST);
            $productId = (int) $_POST['product_id'];
            $number = (int)$_POST['number'];
            $color = $_POST['color'];
            $sizeId = (int) $_POST['size_id'];
            $price = (float) $_POST['price'];
            try {
                $this->bus->handle(new CreateNewPropertyCommand(
                    productId: $productId,
                    number: $number,
                    color: $color,
                    sizeId: $sizeId,
                    path: $path,
                    price: $price
                ));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson()
                );
            } catch (NotFoundException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                    new HttpResponseJson(success: false, message: "not found product!")
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

    public function executePut()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $response->build();
    }

    public function executeDelete()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $response = new HttpResponse();
        $validator = Validator::key("id", Validator::intType()->notEmpty());
        try {
            $validator->assert($body);
            $propertyId = $body['id'];
            try {
                $this->bus->handle(new DeletePropertyCommand(propertyId: $propertyId));
                $response->statusCode(HttpStatusCode::OK)->json(
                    new HttpResponseJson()
                );
            } catch (NotFoundException $e) {
                error_log($e, LOG_INFO);
                $response->statusCode(HttpStatusCode::BAD_REQUEST)->json(
                    new HttpResponseJson(success: false, message: "not found property!")
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

$controller = new PropertiesController();
$controller->execute();
