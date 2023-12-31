<?php

declare(strict_types=1);

namespace App\Shared\Application\Exception;

class ApplicationException extends \Exception
{
    protected function __construct(string $message, \Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }

    public static function create(string $message, \Throwable $previous = null): static
    {
        return new static($message, $previous);
    }
}
