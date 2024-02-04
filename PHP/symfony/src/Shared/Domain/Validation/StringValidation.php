<?php

declare(strict_types=1);

namespace App\Shared\Domain\Validation;

use App\Shared\Domain\Exception\NotNullOrEmptyException;

class StringValidation
{
    public static function isNotEmpty(string $value, string $message): void
    {
        if (empty($value)) {
            throw NotNullOrEmptyException::notNullOrEmpty($message);
        }
    }

    public static function hasMaxLength(string $value, int $maxLength, string $message): void
    {
        if (mb_strlen($value) > $maxLength) {
            throw new \InvalidArgumentException($message);
        }
    }

    public static function hasMinLength(string $value, int $minLength, string $message): void
    {
        if (mb_strlen($value) < $minLength) {
            throw new \InvalidArgumentException($message);
        }
    }
}
