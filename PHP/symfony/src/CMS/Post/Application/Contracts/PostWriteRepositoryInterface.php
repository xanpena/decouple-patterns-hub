<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\Contracts;

use App\CMS\Post\Application\DTO\PostDTO;

interface PostWriteRepositoryInterface
{
    public function findOne(int $id);

    public function save(PostDTO $postDTO): void;

    public function update(int $id, PostDTO $postDTO): void;

    public function delete(int $id): void;
}
