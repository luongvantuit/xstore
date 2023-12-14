<?php

namespace XStore\ServiceLayers\Exceptions;

use Exception;
use XStore\X\Response\HttpStatusCode;

class NotFoundException extends Exception
{
    public function __construct(string $message = "not found!")
    {
        parent::__construct($message, HttpStatusCode::NOT_FOUND);
    }
}
