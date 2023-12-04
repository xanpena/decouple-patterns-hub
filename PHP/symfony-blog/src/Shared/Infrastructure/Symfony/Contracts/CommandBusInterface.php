<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Contracts;

use App\Shared\Application\Contracts\CommandInterface;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
