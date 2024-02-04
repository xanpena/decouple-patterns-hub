<?php

declare(strict_types=1);

namespace App\Blog\Post\Application\Command\CreatePost;

use App\Blog\Post\Application\Contracts\PostRepositoryInterface;
use App\Blog\Post\Domain\Post;
use App\Shared\Application\Contracts\CommandHandlerInterface;

class CreatePostCommandHandler implements CommandHandlerInterface
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(CreatePostCommand $command): void
    {
        $post = Post::create(
            $command->getBody(),
            $command->getId(),
            $command->getTitle(),
            $command->getAuthorId(),
            $command->getAuthorEmail(),
            $command->getAuthorName()
        );

        $this->postRepository->save($post);
    }
}
