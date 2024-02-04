<?php

declare(strict_types=1);

namespace Ecommerce\User\Application\Command;

class SignUpCommandHandler
{
    public function __construct(
        private SignUpCommand $command
    ) {
    }

    public function __invoke()
    {
    }
}
