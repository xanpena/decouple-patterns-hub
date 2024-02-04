<?php

declare(strict_types=1);

namespace App\Blog\Post\Domain;

use App\Blog\Post\Domain\ValueObjects\PostStatus;

class PublishedPost extends Post
{
    public function unpublish(): void
    {
        if (PostStatus::UNPUBLISHED === $this->status) {
            return;
        }

        $this->status = PostStatus::UNPUBLISHED;

        $this->recordThat(PostUnpublished::fromPostId(
            $this->id()
        ));
    }
}
