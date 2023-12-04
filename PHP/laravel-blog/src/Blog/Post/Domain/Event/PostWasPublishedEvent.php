<?php

namespace App\Blog\Post\Domain\Event;

use App\Blog\Post\Domain\Post;
use App\Shared\Domain\Event\AbstractDomainEvent;

class PostWasPublishedEvent extends AbstractDomainEvent
{
    public const EVENT_NAME = 'PostWasPublished';

    protected function __construct(
        private string $id,
        private string $title,
        private string $body,
        private string $authorId
    ) {
        parent::__construct(self::EVENT_NAME);
    }

    public static function fromEntity(Post $post): self
    {
        return new static(
            $post->id(),
            $post->title(),
            $post->body(),
            $post->authorId()
        );
    }
}
