<?php

declare(strict_types=1);

namespace CMS\User\Domain\ValueObjects;

class UserId
{
    private int $value;

    public function __construct(int $id)
    {
        $this->validate($id);
        $this->value = $id;
    }

    private function validate(int $id): void
    {
        if ($id < 1) {
            throw new \InvalidArgumentException('Invalid id');
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
