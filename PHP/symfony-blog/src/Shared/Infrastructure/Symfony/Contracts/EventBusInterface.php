<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Contracts;

interface EventBusInterface
{
    public function dispatch(DomainEventInterface $event): void;
}
