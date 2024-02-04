<?php

declare(strict_types=1);

namespace App\Blog\Post\Application\Contracts;

use App\Blog\Post\Domain\Post;
use App\Blog\Post\Domain\ValueObjects\PostId;

interface PostReadableRepositoryInterface
{
    public function findAll();

    public function findOne(int $postId);
}
