<?php

declare(strict_types=1);

namespace App\ERP\Product\Domain\ValueObjects;

use App\Shared\Domain\Validation\FloatValidation;

class ProductPrice
{
    private float $value;

    public function __construct(float $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    private function validate(float $value): void
    {
        FloatValidation::isPositive($value, 'The price must be greater than 0');
    }

    public function value(): float
    {
        return $this->value;
    }
}
