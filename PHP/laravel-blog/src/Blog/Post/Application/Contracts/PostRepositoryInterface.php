<?php

declare(strict_types=1);

namespace App\Blog\Post\Application\Contracts;

interface PostRepositoryInterface
{
    public function get(): array;

    public function findOne(int $postId);

    public function save(): void;

    public function update(): void;

    public function delete(): void;
}
