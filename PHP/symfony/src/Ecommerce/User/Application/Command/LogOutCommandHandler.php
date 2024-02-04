<?php

declare(strict_types=1);

namespace Ecommerce\User\Application\Command;

class LogOutCommandHandler
{
    public function __construct(
        private LogOutCommand $command
    ) {
    }

    public function __invoke()
    {
    }
}
