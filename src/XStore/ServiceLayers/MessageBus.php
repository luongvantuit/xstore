<?php

namespace XStore\ServiceLayers;

use Exception;
use XStore\Domains\Commands\Command;
use XStore\Domains\Events\Event;
use XStore\ServiceLayers\UnitOfWork\AbstractUnitOfWork;

class MessageBus
{

    private AbstractUnitOfWork $uow;

    private array $eventHandlers;
    private array $commandHandlers;

    private array $queue = [];

    public function __construct(AbstractUnitOfWork $uow, array $eventHandlers, array $commandHandlers)
    {
        $this->uow = $uow;
        $this->eventHandlers = $eventHandlers;
        $this->commandHandlers = $commandHandlers;
    }

    public function handle(Command|Event $message): void
    {
        $this->queue = [$message];
        while (count($this->queue) > 0) {
            $_message = array_pop($this->queue);
            if ($_message instanceof Command) {
                $this->handleCommand($_message);
            } else if ($_message instanceof Event) {
                $this->handleEvent($_message);
            } else {
                throw new Exception("error handler message" . $message);
            }
        }
    }

    public function handleEvent(Event $event): void
    {
        $handlers = $this->eventHandlers[$event::class];
        foreach ($handlers as $handler) {
            try {
                $handler($event);
                $this->queue = array_merge($this->queue, $this->uow->collectNewEvents());
            } catch (Exception $e) {
                continue;
            }
        }
    }

    public function handleCommand(Command $command): void
    {
        $handler = $this->commandHandlers[$command::class];
        $handler($command);
        $this->queue = array_merge($this->queue, $this->uow->collectNewEvents());
    }

    public function getUow(): AbstractUnitOfWork
    {
        return $this->uow;
    }
}
