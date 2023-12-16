<?php

namespace XStore\ServiceLayers\Exceptions;

use Exception;
use XStore\X\Response\HttpStatusCode;

class UsernameExistedException extends Exception
{
    public function __construct(string $message = "username is existed!")
    {
        parent::__construct($message, HttpStatusCode::BAD_REQUEST);
    }
}
