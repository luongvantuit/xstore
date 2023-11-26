<?php

namespace XStore\ServiceLayers\Handlers;

use XStore\Domains\Events\CreatedUserEvent;

function log_id_user(CreatedUserEvent $event): void
{
    echo ("Created user ID " . $event->get_id());
}

const EVENT_HANDLERS = array(
    CreatedUserEvent::class => array("XStore\ServiceLayers\Handlers\log_id_user")
);
