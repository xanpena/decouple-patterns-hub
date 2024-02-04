<?php

declare(strict_types=1);

namespace Ecommerce\User\Application\Command;

class SingInCommandHandler
{
    public function __construct(
        private UserRepository $repository,
        private PasswordEncoder $encoder,
        private TokenGenerator $tokenGenerator
    ) {
    }

    public function __invoke(SingInCommand $command): void
    {
        $user = $this->repository->search($command->email());

        if (null === $user) {
            throw new UserNotFound($command->email());
        }

        if (!$this->encoder->isValid($command->password(), $user->password())) {
            throw new InvalidPassword($command->email());
        }

        $user->signIn($this->tokenGenerator->generate());

        $this->repository->save($user);
    }
}
