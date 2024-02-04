<?php

declare(strict_types=1);

namespace App\CMS\Post\Domain\ValueObjects;

use App\Shared\Domain\Validation\EmailValidation;

final class PostAuthorEmail
{
    private string $value;

    public function __construct(string $email)
    {
        $this->validate($email);
        $this->value = $email;
    }

    private function validate(string $email): void
    {
        EmailValidation::isValid($email, 'Invalid email');
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }
}
