<?php

namespace App\Shared\Infrastructure\Symfony\Assembler;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as DoctrineCollection;

class CollectionAssembler
{
    public function toCollection(array $items): Collection
    {
        return new Collection($items);
    }

    public function toDoctrineCollection(array $items): DoctrineCollection
    {
        return new ArrayCollection($items);
    }
}
