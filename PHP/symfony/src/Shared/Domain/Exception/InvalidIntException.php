<?php

namespace App\Shared\Domain\Exception;

class InvalidIntException extends DomainException
{
    public static function invalidValue(string $className): self
    {
        return new static(sprintf('<%s> cannot be null or empty.', $className));
    }
}
