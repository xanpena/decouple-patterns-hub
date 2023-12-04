<?php

declare(strict_types=1);

namespace App\Blog\Post\Application\Query;

use App\Blog\Post\Domain\Post;

class GetPostsQueryResponse
{
    private function __construct(private int $id, private string $title, private array $author)
    {
    }

    public static function fromEntity(Post $post): self
    {
        $author = [
            'id' => $post->authorId(),
            'name' => $post->authorName(),
            'email' => $post->authorEmail(),
        ];

        return new self($post->id(), $post->title(), $author);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthorId(): int
    {
        return $this->author['id'];
    }

    public function getAuthorName(): string
    {
        return $this->author['name'];
    }

    public function getAuthorEmail(): string
    {
        return $this->author['email'];
    }
}
