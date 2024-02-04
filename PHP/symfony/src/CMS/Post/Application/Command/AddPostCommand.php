<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\Command;

use App\Shared\Application\Contracts\CommandInterface;

class AddPostCommand implements CommandInterface
{
    private int $id;
    private string $title;
    private string $body;
    private int $authorId;
    private string $authorEmail;
    private string $authorName;

    public function __construct(
        int $id,
        string $title,
        string $body,
        int $authorId,
        string $authorEmail,
        string $authorName
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->authorId = $authorId;
        $this->authorEmail = $authorEmail;
        $this->authorName = $authorName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getAuthorEmail(): string
    {
        return $this->authorEmail;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }
}
