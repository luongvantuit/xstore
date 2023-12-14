<?php

namespace XStore\ServiceLayers\Exceptions;

use Exception;
use XStore\X\Response\HttpStatusCode;

class InvalidPasswordException extends Exception
{
    public function __construct(string $message = "unauthorized!")
    {
        parent::__construct($message, HttpStatusCode::UNAUTHORIZED);
    }
}
