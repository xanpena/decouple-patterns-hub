<?php

namespace App\Shared\Domain\Exception;

class CharacterLimitExcededException extends DomainException
{
    public static function exceedLimit(string $className): self
    {
        return new static(sprintf('<%s> exceeds the character limit.', $className));
    }
}
