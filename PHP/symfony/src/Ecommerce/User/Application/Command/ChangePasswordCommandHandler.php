<?php

declare(strict_types=1);

namespace Ecommerce\User\Application\Command;

class ChangePasswordCommandHandler
{
    public function __construct(
        private ChangePasswordCommand $command
    ) {
    }

    public function __invoke()
    {
    }
}
