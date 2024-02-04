<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\Contracts;

use App\CMS\Post\Domain\Post;
use App\CMS\Post\Domain\ValueObjects\PostId;

interface PostReadableRepositoryInterface
{
    public function findAll();

    public function findOne(int $postId);
}
