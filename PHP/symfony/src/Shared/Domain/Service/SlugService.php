<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

final class SlugService
{
    private function __construct()
    {
    }

    public function createSlug(string $title): string
    {
        $slug = strtolower($title);

        $slug = str_replace(' ', '-', $slug);

        $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);

        return $slug;
    }
}
