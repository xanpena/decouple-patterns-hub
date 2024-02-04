<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

use App\Shared\Domain\Contracts\DomainEventInterface;

abstract class AbstractDomainEvent implements DomainEventInterface
{
    protected string $eventName;
    protected int $createdOn;

    protected function __construct(string $eventName)
    {
        $this->eventName = $eventName;
        $this->createdOn = time();
    }

    public function createdOn(): int
    {
        return $this->createdOn;
    }

    public function eventName(): string
    {
        return $this->eventName;
    }
}
