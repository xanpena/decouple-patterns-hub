<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\Query;

use App\CMS\Post\Application\Assembler\PostAssembler;
use App\CMS\Post\Application\Contracts\PostRepositoryInterface;
use App\CMS\Post\Application\Dto\PostDto;
use App\CMS\Post\Domain\Entity\Post;
use App\Shared\Application\Contracts\QueryHandlerInterface;
use App\Shared\Application\Exception\NotFoundException;

final class GetPostByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private PostAssembler $postAssembler
    ) {
        $this->postRepository = $postRepository;
        $this->postAssembler = $postAssembler;
    }

    public function __invoke(GetPostByIdQuery $query): PostDto
    {
        $postId = $query->getPostId();
        $post = $this->postRepository->findOne($postId);

        $this->guardAgainstPostNotFound($post, $postId);

        return $this->postAssembler->toDto($post);
    }

    private function guardAgainstPostNotFound(?Post $post, int $postId): void
    {
        if (null === $post) {
            throw NotFoundException::notFound(sprintf('Post with ID %d not found', $postId));
        }
    }
}
