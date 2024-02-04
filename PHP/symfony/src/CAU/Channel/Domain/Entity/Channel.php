<?php

declare(strict_types=1);

namespace App\CAU\Channel\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

class Channel implements AggregateRoot
{
    use DomainEventsRecorderTrait;

    private function __construct(
        protected readonly ChannelName $name,
    ) {
        $this->title = $title;
    }
}
