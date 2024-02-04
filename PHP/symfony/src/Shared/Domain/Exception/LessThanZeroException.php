<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exception;

class LessThanZeroException extends DomainException
{
    public static function lessThanZero(string $className): self
    {
        return new static(sprintf('<%s> must be greater than 0.', $className));
    }
}
