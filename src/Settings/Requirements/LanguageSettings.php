<?php

namespace GamingEngine\Installation\Settings\Requirements;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Requirements\RequirementDetail;
use Illuminate\Support\Collection;

class LanguageSettings implements Requirement
{
    private array $overrides;

    public function __construct(array $overrides = [])
    {
        $this->overrides = $overrides;
    }

    public function identifier(): string
    {
        return 'language';
    }

    public function title(): string
    {
        return (string)__("gaming-engine:installation::requirements.settings.language.title");
    }

    public function description(): string
    {
        return (string)__("gaming-engine:installation::requirements.settings.language.description");
    }

    public function check(): bool
    {
        return $this->components()
                ->first(fn (RequirementDetail $detail) => ! $detail->check()) === null;
    }

    public function components(): Collection
    {
        $components = collect([
            new LanguageConfigurationValue([
                'attribute' => 'locale',
                'configurationKey' => 'locale',
                'environmentVariable' => 'APP_LOCALE',
            ]),
        ])->keyBy(fn (LanguageConfigurationValue $value) => $value->attribute());

        foreach ($this->overrides as $key => $value) {
            $components[$key]->override($value);
        }

        return $components;
    }
}
