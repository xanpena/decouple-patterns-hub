<?php

declare(strict_types=1);

namespace App\CMS\Menu\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Event\DomainEventsRecorderTrait;

class Menu extends AggregateRoot
{
    use DomainEventsRecorderTrait;

    public function __construct(
        private readonly MenuName $name,
        private readonly MenuSlug $slug
    ) {
    }

    public function name(): string
    {
        return $this->name->value();
    }

    public function slug(): string
    {
        return $this->slug->value();
    }
}
