<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\Assembler;

use App\CMS\Post\Domain\Entity\Post;
use App\CMS\Post\Domain\ValueObjects\PostAuthorEmail;
use App\CMS\Post\Domain\ValueObjects\PostAuthorId;
use App\CMS\Post\Domain\ValueObjects\PostAuthorName;
use App\CMS\Post\Domain\ValueObjects\PostBody;
use App\CMS\Post\Domain\ValueObjects\PostId;
use App\CMS\Post\Domain\ValueObjects\PostTitle;
use App\CMS\Post\Application\DTO\PostDTO;

class PostAssembler
{

    private function __construct()
    {
    }

    public function toDTO(Post $post): PostDTO
    {
        return new PostDTO(
            $post->id(),
            $post->title(),
            $post->body(),
            $post->authorId(),
            $post->authorEmail(),
            $post->authorName()
        );
    }

    public function toEntity(PostDTO $dto): Post
    {
        return new Post(
            new PostAuthorEmail($dto->authorEmail),
            new PostAuthorId($dto->authorId),
            new PostAuthorName($dto->authorName),
            new PostBody($dto->body),
            new PostId($dto->id),
            new PostTitle($dto->title)
        );
    }
}
