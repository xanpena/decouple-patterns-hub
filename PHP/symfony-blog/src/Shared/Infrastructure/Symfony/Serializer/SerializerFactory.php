<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Serializer;

use Symfony\Component\Serializer\SerializerInterface;

interface SerializerFactory
{
    public function create(): SerializerInterface;
}
