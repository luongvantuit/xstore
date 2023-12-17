<?php

namespace XStore\ServiceLayers\Handlers;

use XStore\Adapters\Hashing\AbstractHashing;
use XStore\Domains\Commands\AdminLoginCommand;
use XStore\Domains\Commands\CreateNewAdminCommand;
use XStore\Domains\Commands\CreateNewUserCommand;
use XStore\Domains\Commands\InitialAdminCommand;
use XStore\Domains\Events\CreatedUserEvent;
use XStore\Domains\Models\User;
use XStore\ServiceLayers\UnitOfWork\AbstractUnitOfWork;
use XStore\Domains\Commands\UserLoginCommand;
use XStore\Domains\Events\CreatedAdminEvent;
use XStore\Domains\Models\Admin;
use XStore\ServiceLayers\Exceptions\EmailExistedException;
use XStore\ServiceLayers\Exceptions\InvalidPasswordException;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\ServiceLayers\Exceptions\RootWasInitiatedException;
use XStore\ServiceLayers\Exceptions\UsernameExistedException;
use XStore\Domains\Commands\AddProductToCartCommand;
use XStore\Domains\Models\OrderStatus;
use XStore\Domains\Models\Order;
use XStore\Domains\Models\OrderProduct;
use XStore\Domains\Models\Property;
use XStore\Domains\Commands\DeleteCartProductCommand;
use XStore\Domains\Commands\UpdateCartProductCommand;

function createNewAdmin(CreateNewAdminCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->getRepository();
    /** @var Admin $model */
    $model = $repo->get(Admin::class, array("username" => strtolower($command->getUsername())));
    if ($model != null) {
        throw new UsernameExistedException();
    }
    $uow->beginTransaction();
    $passwordHash = $hashing->hash($command->getPassword());
    $model = new Admin(
        username: strtolower($command->getUsername()),
        password: $passwordHash,
        email: $command->getEmail() == null ? null : strtolower($command->getEmail())
    );
    $repo->add($model);
    $uow->commit();
    $event = new CreatedAdminEvent($model->getId());
    $model->setEvents(array($event));
}

function createNewUser(CreateNewUserCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->getRepository();
    /** @var User $model */
    $model = $repo->get(User::class, array("email" => strtolower($command->getEmail())));
    if ($model != null) {
        throw new EmailExistedException();
    }
    $model = $repo->get(User::class, array("username" => strtolower($command->getUsername())));
    if ($model != null) {
        throw new UsernameExistedException();
    }
    $uow->beginTransaction();
    $passwordHash = $hashing->hash($command->getPassword());
    $model = new User(
        username: strtolower($command->getUsername()),
        email: strtolower($command->getEmail()),
        password: $passwordHash,
    );
    $repo->add($model);
    $uow->commit();
    $event = new CreatedUserEvent($model->getId());
    $model->setEvents(array($event));
}

function loginUser(UserLoginCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->getRepository();
    /** @var User $model */
    $model = $repo->get(User::class, array("email" => strtolower($command->getIdentify())));
    if ($model == null) {
        /** @var User $model */
        $model = $repo->get(User::class, array("username" => strtolower($command->getIdentify())));
    }
    if ($model == null) {
        throw new NotFoundException();
    }
    if (!$hashing->compare($command->getPassword(), $model->getPassword())) {
        throw new InvalidPasswordException();
    }
}

function loginAdmin(AdminLoginCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->getRepository();
    /** @var Admin $model */
    $model = $repo->get(Admin::class, array("username" => strtolower($command->getIdentify())));
    if ($model == null) {
        throw new NotFoundException();
    }
    if (!$hashing->compare($command->getPassword(), $model->getPassword())) {
        throw new InvalidPasswordException();
    }
}

function initialAdmin(InitialAdminCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->getRepository();
    /** @var Admin $model */
    $model = $repo->get(Admin::class, array("username" => "root"));
    if ($model != null) {
        throw new RootWasInitiatedException();
    }
    $uow->beginTransaction();
    $passwordHash = $hashing->hash($command->getPassword());
    $model = new Admin(
        username: "root",
        password: $passwordHash,
        isRoot: true
    );
    $repo->add($model);
    $uow->commit();
}

function addProductToCart(AddProductToCartCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();
    /** @var User $model */
    $user = $repo->get(User::class, array("id" => $command->getUserId()));
    if ($user == null) {
        throw new NotFoundException();
    }
    /** @var Order $model */
    $order = $repo->get(Order::class, array("user_id" => $command->getUserId(), "status" => OrderStatus::INCARD));
    if ($order == null) {
        $order = new Order(
            user: $user,
            address: null,
            typeShippingFee: null,
            status: OrderStatus::INCARD
        );
        $repo->add($order);
    }
    /** @var Property $model */
    $property = $repo->get(Property::class, array("id" => $command->getPropertyId()));
    if ($property == null) {
        throw new NotFoundException();
    }
    /** @var OrderProduct $model */
    $order_product = new OrderProduct(
        order: $order,
        property: $property,
        number: $command->getNumber()
    );
    $repo->add($order_product);
    $uow->commit();
}

function deleteCartProduct(DeleteCartProductCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();
    $repo->remove(
        OrderProduct::class,
        array("id" => $command->getOrderPropertyId(), "order.user.id" => $command->getUserId())
    );
    $uow->commit();
}

function updateCartProductCommand(UpdateCartProductCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();

    if ($command->getNumber() == 0) {
        $repo->remove(
            OrderProduct::class,
            array("id" => $command->getOrderPropertyId(), "order.user.id" => $command->getUserId())
        );
        $uow->commit();
    } else {
        /** @var OrderProduct $model */
        $model = $repo->get(
            OrderProduct::class,
            array("id" => $command->getOrderPropertyId(), "order.user.id" => $command->getUserId())
        );
        if ($model == null) {
            throw new NotFoundException();
        }
        $model->setNumber($command->getNumber());
        $model->setProperty($repo->get(Property::class, array("id" => $command->getPropertyId())));
        $uow->commit();
    }
}

const COMMAND_HANDLERS = array(
    CreateNewUserCommand::class => "XStore\ServiceLayers\Handlers\createNewUser",
    UserLoginCommand::class => "XStore\ServiceLayers\Handlers\loginUser",
    CreateNewAdminCommand::class => "XStore\ServiceLayers\Handlers\createNewAdmin",
    AdminLoginCommand::class => "XStore\ServiceLayers\Handlers\loginAdmin",
    InitialAdminCommand::class => "XStore\ServiceLayers\Handlers\initialAdmin",
    AddProductToCartCommand::class => "XStore\ServiceLayers\Handlers\addProductToCart",
    DeleteCartProductCommand::class => "XStore\ServiceLayers\Handlers\deleteCartProduct"
);
