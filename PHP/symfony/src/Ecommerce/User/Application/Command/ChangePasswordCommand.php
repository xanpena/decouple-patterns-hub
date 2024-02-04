<?php

declare(strict_types=1);

namespace Ecommerce\User\Application\Command;

class ChangePasswordCommand
{
    public function __construct(
        private string $userId,
        private string $password
    ) {
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function password(): string
    {
        return $this->password;
    }
}
