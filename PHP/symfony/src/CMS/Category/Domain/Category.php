<?php

declare(strict_types=1);

namespace App\CMS\Category\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Event\DomainEventsRecorderTrait;

class Category implements AggregateRoot
{
    use DomainEventsRecorderTrait;

    private function __construct(
        protected readonly CategoryDescription $description,
        protected readonly CategoryId $id,
        protected readonly CategoryName $name,
        protected readonly CategoryLang $lang,
        protected readonly CategorySlug $slug
    ) {
        $this->description = $description;
        $this->id = $id;
        $this->name = $name;
        $this->lang = $lang;
        $this->slug = $slug;
    }
}
