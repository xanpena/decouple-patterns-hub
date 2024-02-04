<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\Policy;

use App\CMS\Post\Application\DTO\PostDTO;
use App\CMS\User\Application\DTO\UserDTO;

class PostPolicy
{
    private function __construct()
    {
    }

    public function view(UserDTO $user, PostDTO $post): bool
    {
        return $user->getId() === $post->getAuthorId();
    }

    public function create(UserDTO $user): bool
    {
        return $user->getRole() === 'admin';
    }

    public function owner(UserDTO $user): array
    {
        return ['user_id' => $user->id];
    }
}
