<?php

namespace XStore\Adapters\Notifications;


class PhpMailerNotification extends AbstractEmailNotification
{
    public function send(string $destination, string $subject, string $body): void
    {
    }
}
