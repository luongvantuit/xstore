<?php

namespace XStore\ServiceLayers\Exceptions;

use Exception;
use XStore\X\Response\HttpStatusCode;

class EmailExistedException extends Exception
{
    public function __construct(string $message = "email is existed!")
    {
        parent::__construct($message, HttpStatusCode::BAD_REQUEST);
    }
}
