<?php

declare(strict_types=1);

namespace App\Blog\Post\Application\Query;

use App\Blog\Post\Domain\ValueObjects\PostId;
use App\Shared\Application\Contracts\QueryInterface;

final class GetPostQuery implements QueryInterface
{
    private PostId $postId;

    private function __construct(int $postId)
    {
        $this->postId = new PostId($postId);
    }

    public static function create(int $postId): self
    {
        return new static($postId);
    }

    public function getPostId(): PostId
    {
        return $this->postId;
    }
}
