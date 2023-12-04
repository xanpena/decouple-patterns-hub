<?php

declare(strict_types=1);

namespace App\Tests\Blog\Post\Application\Query;

use App\Blog\Post\Application\Query\GetPostQueryResponse;
use App\Blog\Post\Domain\Post;
use PHPUnit\Framework\TestCase;

class GetPostQueryResponseTest extends TestCase
{
    public function testFromEntity()
    {
        $postId = 1;
        $postTitle = 'Test Post';
        $postBody = 'This is a test post.';
        $postAuthorId = 123;
        $postAuthorName = 'John Doe';
        $postAuthorEmail = 'john.doe@example.com';

        $postMock = $this->createMock(Post::class);
        $postMock
            ->expects($this->once())
            ->method('id')
            ->willReturn($postId);
        $postMock
            ->expects($this->once())
            ->method('title')
            ->willReturn($postTitle);
        $postMock
            ->expects($this->once())
            ->method('body')
            ->willReturn($postBody);
        $postMock
            ->expects($this->once())
            ->method('authorId')
            ->willReturn($postAuthorId);
        $postMock
            ->expects($this->once())
            ->method('authorName')
            ->willReturn($postAuthorName);
        $postMock
            ->expects($this->once())
            ->method('authorEmail')
            ->willReturn($postAuthorEmail);

        $result = GetPostQueryResponse::fromEntity($postMock);

        $this->assertInstanceOf(GetPostQueryResponse::class, $result);
        $this->assertSame($postId, $result->getId());
        $this->assertSame($postTitle, $result->getTitle());
        $this->assertSame($postBody, $result->getBody());
        $this->assertSame($postAuthorId, $result->getAuthorId());
        $this->assertSame($postAuthorName, $result->getAuthorName());
        $this->assertSame($postAuthorEmail, $result->getAuthorEmail());
    }
}
