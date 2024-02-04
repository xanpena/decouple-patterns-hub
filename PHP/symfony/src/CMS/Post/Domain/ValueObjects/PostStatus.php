<?php

declare(strict_types=1);

namespace App\CMS\Post\Domain\ValueObjects;

use App\Shared\Domain\Exception\InvalidIntException;

final class PostStatus
{
    private int $value;

    public const UNPUBLISHED = 0;
    public const PUBLISHED = 1;

    public function __construct(int $status)
    {
        $this->validate($status);
        $this->value = $status;
    }

    private function validate(int $status): void
    {
        $options = [
            'options' => [
                'min_range' => 1,
            ],
        ];

        if (!filter_var($status, FILTER_VALIDATE_INT, $options)) {
            throw InvalidIntException::invalidValue(static::class);
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
