<?php

declare(strict_types=1);

namespace Ecommerce\User\Application\Command;

class ForgetMyAccountCommand
{
    public function __construct(
        private string $email
    ) {
    }

    public function email(): string
    {
        return $this->email;
    }
}
