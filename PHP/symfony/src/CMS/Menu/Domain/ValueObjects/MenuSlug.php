<?php

declare(strict_types=1);

namespace App\CMS\Menu\Domain\ValueObjects;

use App\Shared\Domain\Exception\CharacterLimitExcededException;
use App\Shared\Domain\Exception\NotNullOrEmptyException;
use App\Shared\Domain\Service\SlugService;

final class MenuSlug
{
    private string $value;

    public function __construct(string $title, SlugService $slugService)
    {
        $this->validate($title);
        $this->value = $slugService->createSlug($title);
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
