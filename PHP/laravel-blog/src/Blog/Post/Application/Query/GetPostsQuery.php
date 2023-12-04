<?php

declare(strict_types=1);

namespace App\Blog\Post\Application\Query;

use App\Shared\Application\Contracts\QueryInterface;

final class GetPostsQuery implements QueryInterface
{
    private function __construct()
    {
    }

    public static function create(): self
    {
        return new static();
    }
}
