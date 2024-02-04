<?php

declare(strict_types=1);

namespace App\Shared\Domain\Validation;

use App\Shared\Domain\Exception\LessThanZeroException;

class IntValidation
{
    private function __construct()
    {
    }

    public static function isPositive(int $value, string $message): void
    {
        if ($value <= 0) {
            throw LessThanZeroException::lessThanZero($message);
        }
    }
}
