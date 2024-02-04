<?php

declare(strict_types=1);

namespace Ecommerce\User\Application\Command;

class SignInCommand
{
    public function __construct(
        private string $email,
        private string $password
    ) {
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
