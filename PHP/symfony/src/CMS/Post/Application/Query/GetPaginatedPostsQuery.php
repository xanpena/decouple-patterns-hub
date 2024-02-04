<?php

declare(strict_types=1);

namespace App\CMS\Post\Application\Query;

class GetPaginatedPostsQuery
{

    private int $page;
    private int $pageSize;

    private function __construct(int $page, int $pageSize)
    {
        $this->page = $page;
        $this->pageSize = $pageSize;
    }

    public static function create(int $page, int $pageSize): self
    {
        return new static($page, $pageSize);
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }
}
