<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\DTO;

class PostDTO
{
    public string $body;
    public int $id;
    public string $title;
    public int $authorId;
    public string $authorEmail;
    public string $authorName;

    public function getBody(): string
    {
        return $this->body;
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

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'authorId' => $this->getAuthorId(),
            'authorEmail' => $this->getAuthorEmail(),
            'authorName' => $this->getAuthorName(),
        ];
    }
}
