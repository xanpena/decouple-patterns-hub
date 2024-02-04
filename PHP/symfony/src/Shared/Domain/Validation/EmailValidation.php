<?php

declare(strict_types=1);

namespace App\Shared\Domain\Validation;

class EmailValidation
{
    public static function isValid(string $email, string $message): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException($message);
        }
    }
}
