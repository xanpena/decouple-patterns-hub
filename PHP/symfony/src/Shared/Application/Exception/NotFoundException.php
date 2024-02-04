<?php

declare(strict_types=1);

namespace App\Shared\Application\Exception;

class NotFoundException extends ApplicationException
{
    public static function notFound(string $className): self
    {
        return new static(sprintf('<%s> not found.', $className));
    }
}
