<?php

declare(strict_types=1);

namespace App\Blog\Post\Infrastructure\Laravel\Repositories;

use App\Blog\Post\Application\Contracts\PostRepositoryInterface;
use App\Blog\Post\Infrastructure\Laravel\EloquentModels\PostEloquentModel;

class PostRepository implements PostRepositoryInterface
{

    private PostEloquentModel $postEloquentModel;

    public function __construct()
    {
        $this->postEloquentModel = new PostEloquentModel();
    }

    public function get(): array
    {
        return [];
    }

    public function find()
    {
    }

    public function findOne(int $postId)
    {
    }

    public function save(): void
    {
    }

    public function update(): void
    {
    }

    public function delete(): void
    {
    }
}
