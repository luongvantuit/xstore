<?php

namespace XStore\ServiceLayers\Handlers;

use XStore\Adapters\Notifications\AbstractEmailNotification;
use XStore\Domains\Events\CreatedUserEvent;

function send_email_welcome_after_create_user(CreatedUserEvent $event, AbstractEmailNotification $email_notification): void
{
}

const EVENT_HANDLERS = array(
    CreatedUserEvent::class => array("XStore\ServiceLayers\Handlers\send_email_welcome_after_create_user")
);
