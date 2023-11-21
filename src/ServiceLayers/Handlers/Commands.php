<?php

namespace ServiceLayers\Handlers\Commands;

require_once __DIR__ . "/../../Domains/Commands.php";

use Domains\Commands\PrintHelloWorld;

function print_hello_world(PrintHelloWorld $command): void
{
    echo "Hello World";
}

const COMMAND_HANDLERS = array(
    PrintHelloWorld::class => 'print_hello_world',
);
