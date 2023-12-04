<?php

declare(strict_types=1);

namespace App\Tests\Blog\Post\Application\Query;

use App\Blog\Post\Application\Contracts\PostRepositoryInterface;
use App\Blog\Post\Application\Query\GetPostQuery;
use App\Blog\Post\Application\Query\GetPostQueryHandler;
use App\Blog\Post\Application\Query\GetPostQueryResponse;
use App\Blog\Post\Domain\Post;
use App\Blog\Post\Domain\ValueObjects\PostId;
use PHPUnit\Framework\TestCase;

class GetPostQueryHandlerTest extends TestCase
{
    public function testHandleGetPostQuery()
    {
        $postId = 1;
        $postMock = $this->createMock(Post::class);
        
        $postRepositoryMock = $this->createMock(PostRepositoryInterface::class);
        $postRepositoryMock
            ->expects($this->once())
            ->method('findOne')
            ->with($this->equalTo(new PostId($postId)))
            ->willReturn($postMock);

        $getPostQuery = GetPostQuery::create($postId);
        $getPostQueryHandler = new GetPostQueryHandler($postRepositoryMock);

        $result = $getPostQueryHandler->__invoke($getPostQuery);

        $this->assertInstanceOf(GetPostQueryResponse::class, $result);
    }
}
