<?php

declare(strict_types=1);

namespace App\ERP\Product\Domain\ValueObjects;

use App\Shared\Domain\Exception\InvalidIntException;

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
        $options = [
            'options' => [
                'min_range' => 1,
            ],
        ];

        if (!filter_var($id, FILTER_VALIDATE_INT, $options)) {
            throw InvalidIntException::invalidValue(static::class);
        }
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
