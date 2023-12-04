<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Contracts;

use App\Shared\Application\Contracts\QueryInterface;

interface QueryBusInterface
{
    public function handle(QueryInterface $query): mixed;
}
