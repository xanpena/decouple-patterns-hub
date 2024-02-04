<?php

declare(strict_types=1);

namespace App\CMS\Site\Domain;

use App\CMS\Site\Domain\ValueObjects\SiteDomain;
use App\CMS\Site\Domain\ValueObjects\SiteDomainExtension;
use App\CMS\Site\Domain\ValueObjects\SiteFavicon;
use App\CMS\Site\Domain\ValueObjects\SiteName;
use App\CMS\Site\Domain\ValueObjects\SiteLang;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Event\DomainEventsRecorderTrait;

class Site implements AggregateRoot
{
    use DomainEventsRecorderTrait;

    private function __construct(
        protected readonly SiteDomain $domain,
        protected readonly SiteDomainExtension $domainExtension,
        protected readonly SiteFavicon $favicon,
        protected readonly SiteName $name,
        protected readonly SiteLang $lang,
        protected readonly SiteAnalyticsTag $analyticsTag
    ) {
        $this->domain = $domain;
        $this->domainExtension = $domainExtension;
        $this->favicon = $favicon;
        $this->name = $name;
        $this->lang = $lang;
    }

    public function domain(): string
    {
        return $this->domain->value();
    }

    public function domainExtension(): string
    {
        return $this->domainExtension->value();
    }

    public function favicon(): string
    {
        return $this->favicon->value();
    }

    public function name(): string
    {
        return $this->name->value();
    }
}
