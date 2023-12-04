<?php

declare(strict_types=1);

namespace App\Blog\Post\Application\Contracts;

use App\Blog\Post\Domain\Post;
use App\Blog\Post\Domain\ValueObjects\PostId;

interface PostRepositoryInterface
{
    public function get(): array;

    public function findOne(PostId $postId): ?Post;

    public function save(Post $post): void;

    public function update(PostId $postId, Post $post): void;

    public function delete(PostId $id): void;
}
