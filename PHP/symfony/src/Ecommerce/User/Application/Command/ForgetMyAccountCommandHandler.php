<?php

declare(strict_types=1);

namespace Ecommerce\User\Application\Command;

class ForgetMyAccountCommandHandler
{
    public function __construct(
        private ForgetMyAccountCommand $forgetMyAccountCommand
    ) {
    }

    public function __invoke()
    {
    }
}
