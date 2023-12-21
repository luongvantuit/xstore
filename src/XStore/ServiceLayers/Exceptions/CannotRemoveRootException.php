<?php

namespace XStore\ServiceLayers\Exceptions;

use Exception;
use XStore\X\Response\HttpStatusCode;

class CannotRemoveRootException extends Exception
{
    public function __construct(string $message = "can't remove root admin!")
    {
        parent::__construct($message, HttpStatusCode::BAD_REQUEST);
    }
}
