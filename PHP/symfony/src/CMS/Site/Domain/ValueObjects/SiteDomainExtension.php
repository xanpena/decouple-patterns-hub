<?php

declare(strict_types=1);

namespace App\CMS\Site\Domain\ValueObjects;

final class SiteDomainExtension
{
    private string $value;

    public function __construct(string $name)
    {
        $this->value = $name;
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
