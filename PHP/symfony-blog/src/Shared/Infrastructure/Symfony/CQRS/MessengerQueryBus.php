<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\CQRS;

use App\Shared\Application\Contracts\QueryInterface;
use App\Shared\Infrastructure\Symfony\Contracts\QueryBusInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerQueryBus implements QueryBusInterface
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function handle(QueryInterface $query): mixed
    {
        try {
            return $this->handleQuery($query);
        } catch (HandlerFailedException $e) {
            while ($e instanceof HandlerFailedException) {
                $e = $e->getPrevious();
            }
            throw $e;
        }
    }
}
