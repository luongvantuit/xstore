<?php

namespace XStore\ServiceLayers\Handlers;

use XStore\Adapters\Notifications\AbstractEmailNotification;
use XStore\Domains\Events\CreatedAdminEvent;
use XStore\Domains\Events\CreatedUserEvent;

function sendEmailWelcomeAfterCreateUser(CreatedUserEvent $event, AbstractEmailNotification $emailNotification): void
{
}

function sendEmailWelcomeAfterCreateAdmin(CreatedAdminEvent $event, AbstractEmailNotification $emailNotification): void
{
}


const EVENT_HANDLERS = array(
    CreatedUserEvent::class => array("XStore\ServiceLayers\Handlers\sendEmailWelcomeAfterCreateUser"),
    CreatedAdminEvent::class => array("XStore\ServiceLayers\Handlers\sendEmailWelcomeAfterCreateAdmin")
);
