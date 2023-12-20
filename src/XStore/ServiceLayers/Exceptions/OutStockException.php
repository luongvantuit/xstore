<?php

namespace XStore\ServiceLayers\Exceptions;

use Exception;
use XStore\X\Response\HttpStatusCode;

class OutStockException extends Exception
{
    public function __construct(string $message = "out stock!")
    {
        parent::__construct($message, HttpStatusCode::BAD_REQUEST);
    }
}
