<?php

declare(strict_types=1);

namespace App\ERP\Product\Domain\ValueObjects;

use App\Shared\Domain\Exception\CharacterLimitExcededException;
use App\Shared\Domain\Exception\NotNullOrEmptyException;
use App\Shared\Domain\Validation\StringValidation;

final class ProductName
{
    private string $value;

    public function __construct(string $title)
    {
        $this->validate($title);
        $this->value = $title;
    }

    private function validate(string $title): void
    {
        StringValidation::isNotEmpty($title, 'The title must not be empty');
        StringValidation::hasMaxLength($title, 255, 'The title must not exceed 255 characters');
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }
}
