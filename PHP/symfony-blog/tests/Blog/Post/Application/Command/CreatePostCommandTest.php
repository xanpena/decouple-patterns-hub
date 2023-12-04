<?php

declare(strict_types=1);

namespace App\Tests\Blog\Post\Application\Command\CreatePost;

use App\Blog\Post\Application\Command\CreatePost\CreatePostCommand;
use PHPUnit\Framework\TestCase;

class CreatePostCommandTest extends TestCase
{
    public function testCreatePostCommand(): void
    {
        $id = 1;
        $title = 'Test Post';
        $body = 'This is a test post';
        $authorId = 123;
        $authorEmail = 'test@example.com';
        $authorName = 'John Doe';

        $command = new CreatePostCommand($id, $title, $body, $authorId, $authorEmail, $authorName);

        $this->assertEquals($id, $command->getId());
        $this->assertEquals($title, $command->getTitle());
        $this->assertEquals($body, $command->getBody());
        $this->assertEquals($authorId, $command->getAuthorId());
        $this->assertEquals($authorEmail, $command->getAuthorEmail());
        $this->assertEquals($authorName, $command->getAuthorName());
    }
}
