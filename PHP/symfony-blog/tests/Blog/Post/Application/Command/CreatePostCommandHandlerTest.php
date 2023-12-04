<?php

declare(strict_types=1);

namespace App\Tests\Blog\Post\Application\Command;

use App\Blog\Post\Application\Command\CreatePost\CreatePostCommand;
use App\Blog\Post\Application\Command\CreatePost\CreatePostCommandHandler;
use App\Blog\Post\Domain\Post;
use App\Blog\Post\Domain\ValueObjects\PostId;
use App\Blog\Post\Application\Contracts\PostRepositoryInterface;

use PHPUnit\Framework\TestCase;

class CreatePostCommandHandlerTest extends TestCase
{
    public function testCreatePost(): void
    {
        $repository = $this->createMock(PostRepositoryInterface::class);
        
        $repository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Post::class));

        $handler = new CreatePostCommandHandler($repository);

        $command = new CreatePostCommand(
            1,
            'Test Title',
            'Test Body',
            123,
            'test@example.com',
            'Test Author'
        );

        $handler->__invoke($command);
    }
}
