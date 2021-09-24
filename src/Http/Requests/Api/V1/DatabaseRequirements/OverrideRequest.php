<?php

namespace GamingEngine\Installation\Http\Requests\Api\V1\DatabaseRequirements;

use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;
use GamingEngine\Installation\Requirements\Database\DatabaseConfigurationRequirements;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class OverrideRequest extends FormRequest
{
    public function rules(): array
    {
        return $this->configurationValues()
            ->keyBy(fn (EnvironmentConfigurationValue $value) => $value->attribute())
            ->map(fn (EnvironmentConfigurationValue $value) => $this->deriveRules($value))
            ->toArray();
    }

    /**
     * @return Collection<EnvironmentConfigurationValue>
     */
    private function configurationValues(): Collection
    {
        return $this->requirements()
            ->components();
    }

    private function requirements(): DatabaseConfigurationRequirements
    {
        return app(DatabaseConfigurationRequirements::class);
    }

    private function deriveRules(EnvironmentConfigurationValue $value): array
    {
        return array_filter([
            $value->nullable() ? 'nullable' : 'required',
        ]);
    }
}
