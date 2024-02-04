<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Contracts;

interface DomainEventInterface
{
    public function createdOn(): int;

    public function eventName(): string;
}
