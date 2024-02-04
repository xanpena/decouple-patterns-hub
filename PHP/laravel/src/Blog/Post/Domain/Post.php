<?php

declare(strict_types=1);

namespace App\Blog\Post\Domain;

use App\Blog\Post\Domain\Event\PostWasCreatedEvent;
use App\Blog\Post\Domain\ValueObjects\PostAuthorEmail;
use App\Blog\Post\Domain\ValueObjects\PostAuthorId;
use App\Blog\Post\Domain\ValueObjects\PostAuthorName;
use App\Blog\Post\Domain\ValueObjects\PostBody;
use App\Blog\Post\Domain\ValueObjects\PostId;
use App\Blog\Post\Domain\ValueObjects\PostTitle;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Event\DomainEventsRecorderTrait;

class Post implements AggregateRoot
{
    use DomainEventsRecorderTrait;

    protected string $body;
    protected int $id;
    protected string $title;
    protected int $status;
    protected int $authorId;
    protected string $authorName;
    protected string $authorEmail;

    private function __construct(
        string $body,
        int $id,
        string $title,
        int $authorId,
        string $authorEmail,
        string $authorName
    ) {
        $this->body = (new PostBody($body))->value();
        $this->id = (new PostId($id))->value();
        $this->title = (new PostTitle($title))->value();
        $this->authorId = (new PostAuthorId($authorId))->value();
        $this->authorName = (new PostAuthorName($authorName))->value();
        $this->authorEmail = (new PostAuthorEmail($authorEmail))->value();
    }

    public function body(): string
    {
        return $this->body;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function authorId(): int
    {
        return $this->authorId;
    }

    public function authorEmail(): string
    {
        return $this->authorEmail;
    }

    public function authorName(): string
    {
        return $this->authorName;
    }

    public static function create(
        string $body,
        int $id,
        string $title,
        int $authorId,
        string $authorEmail,
        string $authorName
    ): self {
        $post = new self($body, $id, $title, $authorId, $authorEmail, $authorName);
        $post->record(PostWasCreatedEvent::fromEntity($post));

        return $post;
    }
}
