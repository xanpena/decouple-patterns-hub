<?php

declare(strict_types=1);

namespace Ecommerce\User\Application\Command;

class LogOutCommand
{
    public function __construct(
        private string $userId
    ) {
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
