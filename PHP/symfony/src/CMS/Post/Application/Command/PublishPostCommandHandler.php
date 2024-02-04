<?php

declare(strict_types=1);

namespace App\Blog\Post\Application\Command;

use App\Shared\Application\Contracts\CommandHandlerInterface;

final class PublishPostCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        // private readonly UnpublishedPostRepository $unpublishedPostRepository
    )
    {
    }

    public function __invoke(PublishPostCommand $command): void
    {
        $command();
        // $post->publish();
    }
}
