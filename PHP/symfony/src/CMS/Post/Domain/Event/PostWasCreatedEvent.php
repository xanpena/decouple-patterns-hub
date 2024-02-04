<?php

declare(strict_types=1);

namespace App\CMS\Post\Domain\Event;

use App\CMS\Post\Domain\Post;
use App\Shared\Domain\Event\AbstractDomainEvent;

class PostWasCreatedEvent extends AbstractDomainEvent
{
    public const EVENT_NAME = 'PostWasCreated';

    protected function __construct(
        private readonly int $id,
        private readonly string $title,
        private readonly string $body,
        private readonly int $authorId
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
