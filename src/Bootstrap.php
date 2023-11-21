<?php
require_once __DIR__ . "/ServiceLayers/Handlers/Events.php";
require_once __DIR__ . "/ServiceLayers/Handlers/Commands.php";
require_once __DIR__ . "/ServiceLayers/UnitOfWork.php";
require_once __DIR__ . "/ServiceLayers/MessageBus.php";


function bootstrap(
    Abstract_Unit_Of_Work $uow,
): Message_Bus {
    # Dependencies pattern
    $dependencies = array("uow" => $uow);
    # Inject event handlers
    $injected_event_handlers = array_map(function ($event_handlers) use ($dependencies) {
        return array_map(function ($handler) use ($dependencies) {
            return inject_dependencies($handler, $dependencies);
        }, $event_handlers);
    }, EVENT_HANDLERS);
    # Inject command handlers
    $injected_command_handlers = array_map(function ($handler) use ($dependencies) {
        return inject_dependencies($handler, $dependencies);
    }, COMMAND_HANDLERS);
    return new Message_Bus(
        uow: $uow,
        event_handlers: $injected_event_handlers,
        command_handlers: $injected_command_handlers,
    );
}

function inject_dependencies($handler, $dependencies)
{
    $reflection = new ReflectionFunction($handler);
    $params = $reflection->getParameters();
    $deps = array_intersect_key($dependencies, array_flip(array_map(function ($param) {
        return $param->name;
    }, $params)));
    return function ($message) use ($handler, $deps) {
        return call_user_func_array($handler, array_merge([$message], $deps));
    };
}