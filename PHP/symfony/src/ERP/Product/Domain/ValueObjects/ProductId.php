<?php

declare(strict_types=1);

namespace App\ERP\Product\Domain\ValueObjects;

use App\Shared\Domain\Exception\InvalidIntException;
use App\Shared\Domain\Validation\IdValidation;

final class ProductId
{
    private int $value;

    public function __construct(int $id)
    {
        $this->validate($id);
        $this->value = $id;
    }

    private function validate(int $id): void
    {
        IdValidation::isValid($id, 'Invalid id');
    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }
}
