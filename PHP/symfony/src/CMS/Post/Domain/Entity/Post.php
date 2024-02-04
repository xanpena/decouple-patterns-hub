<?php

declare(strict_types=1);

namespace App\CMS\Post\Domain\Entity;

use App\CMS\Post\Domain\Event\PostWasCreatedEvent;
use App\CMS\Post\Domain\ValueObjects\PostAuthorEmail;
use App\CMS\Post\Domain\ValueObjects\PostAuthorId;
use App\CMS\Post\Domain\ValueObjects\PostAuthorName;
use App\CMS\Post\Domain\ValueObjects\PostBody;
use App\CMS\Post\Domain\ValueObjects\PostId;
use App\CMS\Post\Domain\ValueObjects\PostStatus;
use App\CMS\Post\Domain\ValueObjects\PostTitle;
use App\CMS\Post\Domain\ValueObjects\PostSlug;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Event\DomainEventsRecorderTrait;

class Post implements AggregateRoot
{
    use DomainEventsRecorderTrait;

    protected PostSlug $slug;

    private function __construct(
        protected readonly PostAuthorEmail $authorName,
        protected readonly PostAuthorId $authorId,
        protected readonly PostAuthorName $authorEmail,
        protected readonly PostBody $body,
        protected readonly PostId $id,
        protected readonly PostTitle $title
    ) {
        $this->authorEmail = $authorEmail;
        $this->authorId = $authorId;
        $this->authorName = $authorName;
        $this->body = $body;
        $this->id = $id;
        $this->title = $title;
        $this->slug = new PostSlug($this->title->value());
    }

    public function body(): string
    {
        return $this->body->value();
    }

    public function id(): int
    {
        return $this->id->value();
    }

    public function title(): string
    {
        return $this->title->value();
    }

    public function status(): int
    {
        return $this->status->value();
    }

    public function authorId(): int
    {
        return $this->authorId->value();
    }

    public function authorEmail(): string
    {
        return $this->authorEmail->value();
    }

    public function authorName(): string
    {
        return $this->authorName->value();
    }

    public static function write(
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
