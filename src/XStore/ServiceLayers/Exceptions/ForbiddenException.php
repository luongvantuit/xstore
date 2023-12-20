<?php

namespace XStore\ServiceLayers\Exceptions;

use Exception;
use XStore\X\Response\HttpStatusCode;

class ForbiddenException extends Exception
{
    public function __construct(string $message = "forbideen!")
    {
        parent::__construct($message, HttpStatusCode::FORBIDDEN);
    }
}
