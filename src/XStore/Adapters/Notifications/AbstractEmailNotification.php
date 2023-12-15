<?php

namespace XStore\Adapters\Notifications;

abstract class AbstractEmailNotification
{
    abstract function send(string $destination, string $subject, string $body): void;
}
