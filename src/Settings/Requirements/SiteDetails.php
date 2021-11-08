<?php

namespace GamingEngine\Installation\Settings\Requirements;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Requirements\RequirementDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SiteDetails implements Requirement
{
    private Collection $components;

    public function __construct(private Request $request, public array $overrides = [])
    {
    }

    public function identifier(): string
    {
        return 'configuration';
    }

    public function title(): string
    {
        return (string)__("gaming-engine:installation::requirements.settings.site.title");
    }

    public function description(): string
    {
        return (string)__("gaming-engine:installation::requirements.settings.site.description");
    }

    public function check(): bool
    {
        return $this->components()
                ->first(fn (RequirementDetail $detail) => ! $detail->check()) === null;
    }

    public function components(): Collection
    {
        if (isset($this->components)) {
            return $this->components;
        }

        $components = collect([
            new SiteConfigurationValue([
                'attribute' => 'name',
                'value' => null,
                'nullable' => false,
            ]),
            new SiteConfigurationValue([
                'attribute' => 'domain',
                'value' => $this->request->getHost(),
                'nullable' => false,
            ]),
        ])->keyBy(fn (SiteConfigurationValue $value) => $value->attribute());

        foreach ($this->overrides as $key => $value) {
            $components[$key]->override($value);
        }

        return $this->components = $components;
    }

    public function siteName(): ?string
    {
        return $this->components()
            ->first(fn (SiteConfigurationValue $value) => 'name' === $value->attribute())
            ->value();
    }

    public function domain(): string
    {
        return $this->components()
            ->first(fn (SiteConfigurationValue $value) => 'domain' === $value->attribute())
            ->value() ?? $this->request->getHost();
    }
}
