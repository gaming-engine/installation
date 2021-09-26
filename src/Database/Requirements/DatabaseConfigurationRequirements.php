<?php

namespace GamingEngine\Installation\Database\Requirements;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Requirements\RequirementDetail;
use Illuminate\Support\Collection;

class DatabaseConfigurationRequirements implements Requirement
{
    private array $overrides;

    public function __construct(array $overrides = [])
    {
        $this->overrides = $overrides;
    }

    public function identifier(): string
    {
        return 'configuration';
    }

    public function name(): string
    {
        return __("gaming-engine:installation::requirements.database.configuration.name");
    }

    public function description(): string
    {
        return __("gaming-engine:installation::requirements.database.configuration.description");
    }

    public function check(): bool
    {
        return $this->components()
                ->first(fn (RequirementDetail $detail) => ! $detail->check()) === null;
    }

    public function components(): Collection
    {
        $components = collect([
            new DatabaseConfigurationValue([
                'attribute' => 'engine',
                'configurationKey' => 'database.default',
                'environmentVariable' => 'DB_CONNECTION',
            ]),
            new DatabaseConfigurationValue([
                'attribute' => 'host',
                'configurationKey' => 'database.host',
                'environmentVariable' => 'DB_HOST',
            ]),
            new DatabaseConfigurationValue([
                'attribute' => 'database-name',
                'configurationKey' => 'database.name',
                'environmentVariable' => 'DB_DATABASE',
            ]),
            new DatabaseConfigurationValue([
                'attribute' => 'username',
                'configurationKey' => 'database.username',
                'environmentVariable' => 'DB_USERNAME',
            ]),
            new DatabaseConfigurationValue([
                'attribute' => 'password',
                'configurationKey' => 'database.password',
                'environmentVariable' => 'DB_PASSWORD',
                'nullable' => true,
            ]),
        ])->keyBy(fn (DatabaseConfigurationValue $value) => $value->attribute());

        foreach ($this->overrides as $key => $value) {
            $components[$key]->override($value);
        }

        return $components;
    }
}
