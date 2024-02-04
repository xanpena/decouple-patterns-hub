<?php 

declare(strict_types=1);

namespace App\Tests\Blog\Post\Domain;

use App\Blog\Post\Domain\Event\PostWasCreatedEvent;
use App\Blog\Post\Domain\Post;
use App\Shared\Domain\Event\DomainEventsRecorderTrait;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    use DomainEventsRecorderTrait;

    public function testCreatePost(): void
    {
        $body = 'Test Body';
        $id = 1;
        $title = 'Test Title';
        $authorId = 123;
        $authorEmail = 'test@example.com';
        $authorName = 'Test Author';

        $post = Post::create($body, $id, $title, $authorId, $authorEmail, $authorName);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertSame($body, $post->body());
        $this->assertSame($id, $post->id());
        $this->assertSame($title, $post->title());
        $this->assertSame($authorId, $post->authorId());
        $this->assertSame($authorEmail, $post->authorEmail());
        $this->assertSame($authorName, $post->authorName());

        $recordedEvents = $post->pullDomainEvents();
        $this->assertCount(1, $recordedEvents);
        $this->assertInstanceOf(PostWasCreatedEvent::class, $recordedEvents[0]);
    }
}
