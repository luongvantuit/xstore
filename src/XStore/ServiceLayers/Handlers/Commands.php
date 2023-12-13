<?php

namespace XStore\ServiceLayers\Handlers;

use XStore\Adapters\Hashing\AbstractHashing;
use XStore\Domains\Commands\CreateUserCommand;
use XStore\Domains\Events\CreatedUserEvent;
use XStore\Domains\Models\User;
use XStore\ServiceLayers\UnitOfWork\AbstractUnitOfWork;
use XStore\Domains\Commands\LoginCommand;
use XStore\ServiceLayers\Exceptions\InvalidPasswordException;
use XStore\ServiceLayers\Exceptions\NotFoundException;

require_once __DIR__ . "/../Utils.php";

function create_user(CreateUserCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->get_repo();
    /** @var User $model */
    $password_hash = $hashing->hash($command->get_password());
    $model = new User(
        username: $command->get_username(),
        email: $command->get_email(),
        password: $password_hash,
    );
    $repo->add($model);
    $uow->commit();
    $event = new CreatedUserEvent($model->get_id());
    $model->set_events(array($event));
}

function login_user(LoginCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->get_repo();
    /** @var User $model */
    $model = $repo->get(User::class, array("email" => $command->get_email()));

    if ($model == null) {
        throw new NotFoundException();
    }
    if (!$hashing->compare($command->get_password(), $model->get_password())) {
        throw new InvalidPasswordException();
    }
}

const COMMAND_HANDLERS = array(
    CreateUserCommand::class => "XStore\ServiceLayers\Handlers\create_user",
    LoginCommand::class => "XStore\ServiceLayers\Handlers\login_user"
);
