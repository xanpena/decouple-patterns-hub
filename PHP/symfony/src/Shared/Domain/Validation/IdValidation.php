<?php

declare(strict_types=1);

namespace App\Shared\Domain\Validation;

use App\Shared\Domain\Exception\InvalidIntException;

class IdValidation
{
    private function __construct()
    {
    }

    public static function isValid(int $id, string $message): void
    {
        if ($id < 1) {
            throw new InvalidIntException($message);
        }
    }
}
