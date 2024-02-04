<?php

declare(strict_types=1);

namespace App\CMS\Page\Domain;

use App\CMS\Page\Domain\ValueObjects\PageContent;
use App\CMS\Page\Domain\ValueObjects\PageTitle;
use App\CMS\Page\Domain\ValueObjects\PageMetaTitle;
use App\CMS\Page\Domain\ValueObjects\PageMetaDescription;
use App\CMS\Page\Domain\ValueObjects\PageSlug;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Event\DomainEventsRecorderTrait;
use App\Shared\Domain\Service\SlugService;

class Page implements AggregateRoot
{
    use DomainEventsRecorderTrait;

    protected PageSlug $slug;
    private SlugService $slugService;

    private function __construct(
        protected readonly PageContent $content,
        protected readonly PageTitle $title,
        protected readonly PageMetaTitle $metaTitle,
        protected readonly PageMetaDescription $metaDescription
    ) {
        $this->content = $content;
        $this->title = $title;
        $this->metaTitle = $metaTitle;
        $this->metaDescription = $metaDescription;
        $this->slug = new PageSlug($this->slugService($this->title->value()));
    }

    public function content(): string
    {
        return $this->content->value();
    }

    public function title(): string
    {
        return $this->title->value();
    }

    public function metaTitle(): string
    {
        return $this->metaTitle->value();
    }

    public function metaDescription(): string
    {
        return $this->metaDescription->value();
    }

    public function slug(): string
    {
        return $this->slug->value();
    }
}
