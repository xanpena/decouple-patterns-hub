<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Assembler;

class Collection implements \IteratorAggregate, \Countable
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function map(callable $callback): self
    {
        return new self(array_map($callback, $this->items));
    }

    // Agrega otros métodos según sea necesario...
}
