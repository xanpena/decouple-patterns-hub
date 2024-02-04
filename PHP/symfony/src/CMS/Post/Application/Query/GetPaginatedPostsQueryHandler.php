<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\Query;

use App\CMS\Post\Application\Assembler\PostAssembler;
use App\CMS\Post\Application\Contracts\PostReadRepositoryInterface;
use App\Shared\Infrastructure\Symfony\Assembler\CollectionAssembler;
use App\Shared\Infrastructure\Symfony\Assembler\Collection;

class GetPaginatedPostsQueryHandler
{

    public function __construct(
        private PostReadRepositoryInterface $postRepository,
        private PostAssembler $postAssembler,
        private CollectionAssembler $collectionAssembler
    ) {
    }

    public function __invoke(GetPaginatedPostsQuery $query): Collection
    {
        $posts = $this->postRepository->paginate($query->getPage(), $query->getPageSize());

        return $this->collectionAssembler->toCollection(
            array_map(function ($post) {
                return $this->postAssembler->toDTO($post);
            }, $posts)
        );
    }
}
