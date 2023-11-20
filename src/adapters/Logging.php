<?php

namespace Adapters\Logging;

abstract class AbstractLogging
{
    abstract public function log($level, $message, array $context = array());
}


class DefaultLogging extends AbstractLogging
{

    public function log($level, $message, array $context = array())
    {
    }
}

?>