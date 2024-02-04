<?php

declare(strict_types=1);

namespace App\Blog\Post\Application\Command\PublishPost;

use App\Blog\Post\Domain\ValueObjects\PostId;
use App\Shared\Application\Contracts\CommandInterface;

final class PublishPostCommand implements CommandInterface
{
    private PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }

    public function __invoke(): void
    {
    }

    public function getPostId(): PostId
    {
        return $this->postId;
    }
}
