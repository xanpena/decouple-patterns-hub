<?php

declare(strict_types=1);

namespace App\Tests\Blog\Post\Application\Query;

use App\Blog\Post\Application\Query\GetPostQuery;
use App\Blog\Post\Domain\ValueObjects\PostId;
use PHPUnit\Framework\TestCase;

class GetPostQueryTest extends TestCase
{
    public function testCreateGetPostQueryWithValidValues()
    {
        $validPostId = 1;

        $getPostQuery = GetPostQuery::create($validPostId);

        $this->assertInstanceOf(GetPostQuery::class, $getPostQuery);
        $this->assertInstanceOf(PostId::class, $getPostQuery->getPostId());
        $this->assertSame($validPostId, $getPostQuery->getPostId()->value());
    }
}
