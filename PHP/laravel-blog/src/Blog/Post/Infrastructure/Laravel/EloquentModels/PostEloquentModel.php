<?php

declare(strict_types=1);

namespace App\Blog\Post\Infrastructure\Laravel\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class PostEloquentModel extends Model
{
    protected $table = 'posts';
}
