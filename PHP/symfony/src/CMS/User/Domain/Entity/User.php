<?php

declare(strict_types=1);

namespace App\CMS\User\Domain\Entity;

use App\CMS\User\Domain\ValueObjects\UserEmail;
use App\CMS\User\Domain\ValueObjects\UserId;
use App\CMS\User\Domain\ValueObjects\UserName;
use App\CMS\User\Domain\ValueObjects\UserPassword;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Event\DomainEventsRecorderTrait;

class User extends AggregateRoot
{
    use DomainEventsRecorderTrait;

    public function __construct(
        protected readonly UserEmail $email,
        protected readonly UserId $id,
        protected readonly UserName $name,
        protected readonly UserPassword $password

    ) {
        $this->email = $email;
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
    }

    public function email(): string
    {
        return $this->email->value();
    }

    public function id(): int
    {
        return $this->id->value();
    }

    public function name(): string
    {
        return $this->name->value();
    }

    public function password(): string
    {
        return $this->password->value();
    }
}
