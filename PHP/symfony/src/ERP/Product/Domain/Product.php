<?php

declare(strict_types=1);

namespace App\ERP\Product\Domain;

use App\ERP\Product\Domain\ValueObjects\ProductId;
use App\ERP\Product\Domain\ValueObjects\ProductName;
use App\ERP\Product\Domain\ValueObjects\ProductDescription;
use App\ERP\Product\Domain\ValueObjects\ProductPrice;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Event\DomainEventsRecorderTrait;

class Product implements AggregateRoot
{
    use DomainEventsRecorderTrait;

    private function __construct(
        protected readonly ProductId $id,
        protected readonly ProductName $name,
        protected readonly ProductDescription $description,
        protected readonly ProductPrice $price
    ) {
        $this->name = $description;
        $this->name = $id;
        $this->name = $name;
        $this->name = $price;
    }

    public function description(): string
    {
        return $this->description->value();
    }

    public function id(): int
    {
        return $this->id->value();
    }

    public function name(): string
    {
        return $this->name->value();
    }

    public function price(): float
    {
        return $this->price->value();
    }
}
