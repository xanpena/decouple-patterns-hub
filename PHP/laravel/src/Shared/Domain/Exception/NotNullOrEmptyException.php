<?php

namespace App\Shared\Domain\Exception;

class NotNullOrEmptyException extends DomainException
{
    public static function notNullOrEmpty(string $className): self
    {
        return new static(sprintf('<%s> cannot be null or empty.', $className));
    }
}
