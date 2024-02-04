<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\Contracts;

use App\CMS\Post\Application\DTO\PostDTO;

interface PostReadRepositoryInterface
{
    public function get(): array;

    public function findOne(int $id);

    public function paginate(int $page, int $pageSize);
}
