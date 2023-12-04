<?php

declare(strict_types=1);

namespace App\Blog\Post\Infrastructure\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            \App\Blog\Post\Application\Contracts\PostRepositoryInterface::class,
            \App\Blog\Post\Infrastructure\Laravel\Repositories\PostRepository::class
        );

        $this->app->bind(
            \App\Blog\Post\Application\Contracts\PostReadableRepositoryInterface::class,
            \App\Blog\Post\Infrastructure\Laravel\Repositories\PostReadableRepository::class
        );
    }
}
