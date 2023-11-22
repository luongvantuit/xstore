<?php

namespace ServiceLayers;

use Domains\Commands\Command;
use Domains\Events\Event;
use Exception;
use UnitOfWork\AbstractUnitOfWork;

class MessageBus
{

    private AbstractUnitOfWork $uow;

    private array $event_handlers;
    private array $command_handlers;

    private array $queue = [];

    public function __construct(AbstractUnitOfWork $uow, array $event_handlers, array $command_handlers)
    {
        $this->uow = $uow;
        $this->event_handlers = $event_handlers;
        $this->command_handlers = $command_handlers;
    }

    public function handle(Command|Event $message): void
    {
        $this->queue = [$message];
        while (count($this->queue) > 0) {
            $_message = array_pop($this->queue);
            if ($_message instanceof Command) {
                $this->handle_command($_message);
            } else if ($_message instanceof Event) {
                $this->handle_event($_message);
            } else {
                throw new Exception("error handler message" . $message);
            }
        }
    }

    public function handle_event(Event $event): void
    {
        $handlers = $this->event_handlers[$event::class];
        foreach ($handlers as $handler) {
            try {
                $handler($event);
                array_merge($this->queue, $this->uow->collect_new_events());
            } catch (Exception $e) {
                continue;
            }
        }
    }

    public function handle_command(Command $command): void
    {
        $handler = $this->command_handlers[$command::class];
        $handler($command);
        array_merge($this->queue, $this->uow->collect_new_events());
    }
}
