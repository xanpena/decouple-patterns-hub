<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\Command;

use App\CMS\Post\Application\Assembler\PostAssembler;
use App\CMS\Post\Application\Contracts\PostRepositoryInterface;
use App\CMS\Post\Domain\Entity\Post;
use App\CMS\Post\Application\DTO\PostDTO;
use App\Shared\Application\Contracts\CommandHandlerInterface;

class AddPostCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private PostAssembler $postAssembler
    ) {
        $this->postRepository = $postRepository;
        $this->postAssembler = $postAssembler;
    }

    public function __invoke(AddPostCommand $command): void
    {
        $post = Post::write(
            $command->getBody(),
            $command->getId(),
            $command->getTitle(),
            $command->getAuthorId(),
            $command->getAuthorEmail(),
            $command->getAuthorName()
        );

        $postDTO = $this->postAssembler->toDTO($post);

        $this->postRepository->save($postDTO);
    }
}
