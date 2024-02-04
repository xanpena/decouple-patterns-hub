<?php

declare(strict_types=1);

namespace App\Blog\Post\Domain\ValueObjects;

final class PostAuthorEmail
{
    private string $value;

    public function __construct(string $email)
    {
        $this->value = $email;
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
