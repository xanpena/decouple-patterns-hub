<?php

declare(strict_types=1);

namespace App\Blog\Post\Infrastructure\Laravel\Repositories;

use App\Blog\Post\Application\Contracts\PostReadableRepositoryInterface;
use App\Blog\Post\Infrastructure\Laravel\EloquentModels\PostEloquentModel;

class PostReadableRepository extends PostRepository implements PostReadableRepositoryInterface
{

    private PostEloquentModel $postEloquentModel;

    public function __construct()
    {
        $this->postEloquentModel = new PostEloquentModel();
    }

    public function findAll()
    {
        $postEloquentCollection = PostEloquentModel::query()/*->where('status', 1)*/->get();
        return $postEloquentCollection;
    }
}
