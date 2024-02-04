<?php

declare(strict_types=1);

namespace App\CMS\Post\Domain;

use App\CMS\Post\Domain\ValueObjects\PostStatus;

class UnpublishedPost extends Post
{
    public function publish(): void
    {
        if (PostStatus::PUBLISHED === $this->status) {
            return;
        }

        $this->status = PostStatus::PUBLISHED;

        $this->recordThat(PostPublished::fromPostId(
            $this->id()
        ));
    }
}
