<?php

declare(strict_types=1);

namespace App\CMS\Post\Domain\ValueObjects;

use App\Shared\Domain\Exception\CharacterLimitExcededException;
use App\Shared\Domain\Exception\NotNullOrEmptyException;

final class PostTitle
{
    private string $value;

    public function __construct(string $title)
    {
        $this->validate($title);
        $this->value = $title;
    }

    private function validate(string $title): void
    {
        if (null === $title || '' === $title) {
            throw NotNullOrEmptyException::notNullOrEmpty(static::class);
        }

        if (mb_strlen($title) > 255) {
            throw CharacterLimitExcededException::exceedLimit(static::class);
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
