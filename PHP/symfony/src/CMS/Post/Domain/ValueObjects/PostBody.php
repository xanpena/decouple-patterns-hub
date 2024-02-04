<?php

declare(strict_types=1);

namespace App\CMS\Post\Domain\ValueObjects;

use App\Shared\Domain\Exception\NotNullOrEmptyException;

final class PostBody
{
    private string $value;

    public function __construct(string $body)
    {
        $this->validate($body);
        $this->value = $body;
    }

    private function validate(?string $body): void
    {
        if (null === $body || '' === $body) {
            throw NotNullOrEmptyException::notNullOrEmpty(static::class);
        }
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
