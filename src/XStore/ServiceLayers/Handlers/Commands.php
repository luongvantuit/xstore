<?php

namespace XStore\ServiceLayers\Handlers;

use XStore\Adapters\Hashing\AbstractHashing;
use XStore\Domains\Commands\AdminLoginCommand;
use XStore\Domains\Commands\CreateNewAdminCommand;
use XStore\Domains\Commands\CreateNewUserCommand;
use XStore\Domains\Events\CreatedUserEvent;
use XStore\Domains\Models\User;
use XStore\ServiceLayers\UnitOfWork\AbstractUnitOfWork;
use XStore\Domains\Commands\UserLoginCommand;
use XStore\Domains\Events\CreatedAdminEvent;
use XStore\Domains\Models\Admin;
use XStore\ServiceLayers\Exceptions\EmailExistedException;
use XStore\ServiceLayers\Exceptions\InvalidPasswordException;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\ServiceLayers\Exceptions\UsernameExistedException;


function create_new_admin(CreateNewAdminCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->get_repo();
    /** @var Admin $model */
    $model = $repo->get(Admin::class, array("username" => strtolower($command->get_username())));
    if ($model != null) {
        throw new UsernameExistedException();
    }
    $uow->begin_transaction();
    $password_hash = $hashing->hash($command->get_password());
    $model = new Admin(
        username: strtolower($command->get_username()),
        password: $password_hash,
        email: $command->get_email() == null ? null : strtolower($command->get_email())
    );
    $repo->add($model);
    $uow->commit();
    $event = new CreatedAdminEvent($model->get_id());
    $model->set_events(array($event));
}

function create_new_user(CreateNewUserCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->get_repo();
    /** @var User $model */
    $model = $repo->get(User::class, array("email" => strtolower($command->get_email())));
    if ($model != null) {
        throw new EmailExistedException();
    }
    $model = $repo->get(User::class, array("username" => strtolower($command->get_username())));
    if ($model != null) {
        throw new UsernameExistedException();
    }
    $uow->begin_transaction();
    $password_hash = $hashing->hash($command->get_password());
    $model = new User(
        username: strtolower($command->get_username()),
        email: strtolower($command->get_email()),
        password: $password_hash,
    );
    $repo->add($model);
    $uow->commit();
    $event = new CreatedUserEvent($model->get_id());
    $model->set_events(array($event));
}

function login_user(UserLoginCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->get_repo();
    /** @var User $model */
    $model = $repo->get(User::class, array("email" => strtolower($command->get_identify())));
    if ($model == null) {
        /** @var User $model */
        $model = $repo->get(User::class, array("username" => strtolower($command->get_identify())));
    }
    if ($model == null) {
        throw new NotFoundException();
    }
    if (!$hashing->compare($command->get_password(), $model->get_password())) {
        throw new InvalidPasswordException();
    }
}

function login_admin(AdminLoginCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->get_repo();
    /** @var Admin $model */
    $model = $repo->get(Admin::class, array("username" => strtolower($command->get_identify())));
    if ($model == null) {
        throw new NotFoundException();
    }
    if (!$hashing->compare($command->get_password(), $model->get_password())) {
        throw new InvalidPasswordException();
    }
}


const COMMAND_HANDLERS = array(
    CreateNewUserCommand::class => "XStore\ServiceLayers\Handlers\create_new_user",
    UserLoginCommand::class => "XStore\ServiceLayers\Handlers\login_user",
    CreateNewAdminCommand::class => "XStore\ServiceLayers\Handlers\create_new_admin",
    AdminLoginCommand::class => "XStore\ServiceLayers\Handlers\login_admin"
);
