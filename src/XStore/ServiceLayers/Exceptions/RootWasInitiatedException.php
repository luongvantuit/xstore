<?php

namespace XStore\ServiceLayers\Exceptions;

use Exception;
use XStore\X\Response\HttpStatusCode;

class RootWasInitiatedException extends Exception
{
    public function __construct(string $message = "root was initiated!")
    {
        parent::__construct($message, HttpStatusCode::NOT_FOUND);
    }
}
