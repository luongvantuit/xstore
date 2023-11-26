<?php

namespace XStore\ServiceLayers\Handlers;

use XStore\Domains\Commands\CreateUserCommand;
use XStore\Domains\Events\CreatedUserEvent;
use XStore\Domains\Models\User;
use XStore\ServiceLayers\UnitOfWork\AbstractUnitOfWork;


function create_user(CreateUserCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->get_repo();
    $model = new User(password: $command->get_password());
    $repo->add($model);
    $uow->commit();
    $event = new CreatedUserEvent($model->get_id());
    $model->set_events(array($event));
}

const COMMAND_HANDLERS = array(
    CreateUserCommand::class => "XStore\ServiceLayers\Handlers\create_user",
);
