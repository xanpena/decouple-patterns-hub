<?php

declare(strict_types=1);

namespace App\Blog\Post\Application\Query;

use App\Blog\Post\Application\Contracts\PostRepositoryInterface;
use App\Shared\Application\Contracts\QueryHandlerInterface;

final class GetPostQueryHandler implements QueryHandlerInterface
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(GetPostQuery $query): GetPostQueryResponse
    {
        $postId = $query->getPostId();

        return GetPostQueryResponse::fromEntity(
            $this->postRepository->findOne($postId)
        );
    }
}
