<?php

declare(strict_types=1);

namespace App\Blog\Post\Application\Query;

use App\Blog\Post\Application\Contracts\PostReadableRepositoryInterface;
use App\Blog\Post\Domain\Post;
use App\Shared\Application\Contracts\QueryHandlerInterface;

final class GetPostsQueryHandler implements QueryHandlerInterface
{
    private PostReadableRepositoryInterface $repository;

    public function __construct(PostReadableRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetPostsQuery $query): array
    {
        $posts = $this->repository->findAll();

        $response = array_map(function (Post $post) {
            return GetPostQueryResponse::fromEntity($post);
        }, $posts->toArray());

        return $response;
    }
}
