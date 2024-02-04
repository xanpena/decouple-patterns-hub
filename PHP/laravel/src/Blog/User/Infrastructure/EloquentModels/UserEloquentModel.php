<?php

declare(strict_types=1);

namespace App\Blog\Post\Infrastructure\Laravel\EloquentModels;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserEloquentModel extends Authenticatable
{
    protected $table = 'users';
}
