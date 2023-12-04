<?php

declare(strict_types=1);

namespace App\Shared\Domain\Contracts;

interface DomainEventInterface
{
    public function createdOn(): int;

    public function eventName(): string;
}
