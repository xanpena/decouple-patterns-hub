<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\Query;

use App\CMS\Post\Domain\ValueObjects\PostId;
use App\Shared\Application\Contracts\QueryInterface;

final class GetPostByIdQuery implements QueryInterface
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

    public function getPostId(): int
    {
        return $this->postId->value();
    }
}
