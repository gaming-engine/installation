<?php

namespace GamingEngine\Installation\Account\Requirements;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Requirements\RequirementDetail;
use Illuminate\Support\Collection;

class AccountConfigurationRequirements implements Requirement
{
    public function __construct(private array $overrides = [])
    {
    }

    public function identifier(): string
    {
        return 'configuration';
    }

    public function title(): string
    {
        return (string)__("gaming-engine:installation::requirements.account.configuration.title");
    }

    public function description(): string
    {
        return (string)__("gaming-engine:installation::requirements.account.configuration.description");
    }

    public function check(): bool
    {
        return $this->components()
                ->first(fn (RequirementDetail $detail) => ! $detail->check()) === null;
    }

    public function components(): Collection
    {
        $components = collect([
            new AccountConfigurationValue([
                'attribute' => 'email',
                'value' => 'admin@admin.com',
            ]),
            new AccountConfigurationValue([
                'attribute' => 'name',
                'value' => 'Admin',
            ]),
            new AccountConfigurationValue([
                'attribute' => 'password',
            ]),
        ])->keyBy(fn (AccountConfigurationValue $value) => $value->attribute());

        foreach ($this->overrides as $key => $value) {
            $components[$key]->override($value);
        }

        return $components;
    }
}
