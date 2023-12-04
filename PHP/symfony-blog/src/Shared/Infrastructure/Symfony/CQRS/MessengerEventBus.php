<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\CQRS;

use App\Shared\Infrastructure\Symfony\Contracts\DomainEventInterface;
use App\Shared\Infrastructure\Symfony\Contracts\EventBusInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerEventBus implements EventBusInterface
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function dispatch(DomainEventInterface $event): void
    {
        try {
            $this->messageBus->dispatch($event);
        } catch (HandlerFailedException $e) {
            while ($e instanceof HandlerFailedException) {
                $e = $e->getPrevious();
            }
            throw $e;
        }
    }
}
