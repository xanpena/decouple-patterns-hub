<?php

declare(strict_types=1);

namespace ERP\Customer\Domain\Entity;

class Customer
{
    public function __construct(
        protected readonly CustomerId $id,
        protected readonly CustomerName $name,
        protected readonly CustomerSurname $surname,
        protected readonly CustomerPhone $phone,
        protected readonly CustomerEmail $email,

    ) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->email = $email;
    }
}
