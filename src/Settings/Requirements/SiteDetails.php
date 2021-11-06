<?php

namespace GamingEngine\Installation\Settings\Requirements;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Requirements\RequirementDetail;
use GamingEngine\StringTools\StringHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SiteDetails implements Requirement
{
    public function __construct(private Request $request, private array $overrides = [])
    {
    }

    public function identifier(): string
    {
        return 'configuration';
    }

    public function name(): string
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
        $components = collect([
            new SiteConfigurationValue([
                'attribute' => 'name',
                'value' => null,
                'nullable' => false,
            ]),
            new SiteConfigurationValue([
                'attribute' => 'domain',
                'value' => $this->deriveUrl(),
                'nullable' => false,
            ]),
        ])->keyBy(fn (SiteConfigurationValue $value) => $value->attribute());

        foreach ($this->overrides as $key => $value) {
            $components[$key]->override($value);
        }

        return $components;
    }

    private function deriveUrl(): string
    {
        return StringHelper::template(
            '{scheme}://{hostname}',
            [
                'scheme' => $this->request->getScheme(),
                'hostname' => $this->request->getHost(),
            ]
        );
    }
}
