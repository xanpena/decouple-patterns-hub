<?php

declare(strict_types=1);

namespace App\Tests\Blog\Post\Domain\ValueObjects;

use App\Blog\Post\Domain\ValueObjects\PostTitle;
use App\Shared\Domain\Exception\CharacterLimitExcededException;
use App\Shared\Domain\Exception\NotNullOrEmptyException;
use PHPUnit\Framework\TestCase;

class PostTitleTest extends TestCase
{
    public function testCreatePostTitleWithValidValue()
    {
        $validTitle = 'Valid Title';

        $postTitle = new PostTitle($validTitle);

        $this->assertInstanceOf(PostTitle::class, $postTitle);
        $this->assertSame($validTitle, $postTitle->value());
    }

    public function testCreatePostTitleWithNullValueThrowsException()
    {
        $invalidTitle = '';

        $this->expectException(NotNullOrEmptyException::class);

        new PostTitle($invalidTitle);
    }

    public function testCreatePostTitleWithEmptyValueThrowsException()
    {
        $invalidTitle = '';

        $this->expectException(NotNullOrEmptyException::class);

        new PostTitle($invalidTitle);
    }

    public function testCreatePostTitleWithExceededCharacterLimitThrowsException()
    {
        $invalidTitle = str_repeat('a', 256);

        $this->expectException(CharacterLimitExcededException::class);

        new PostTitle($invalidTitle);
    }
}
