<?php

require_once "../src/Bootstrap.php";

use Domains\Commands\PrintHelloWorld;
use ServiceLayers\UnitOfWork\Php_Unit_Of_Work;

$bus = bootstrap(new Php_Unit_Of_Work());

$command = new PrintHelloWorld();

$bus->handle($command);
