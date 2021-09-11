<?php

namespace GamingEngine\Installation\Http\Requests\Api\V1\DatabaseRequirements;

use GamingEngine\Installation\Steps\ConfigurationRequirements\ConfigurationValue;
use GamingEngine\Installation\Steps\DatabaseRequirements\DatabaseConfigurationRequirements;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class OverrideRequest extends FormRequest
{
    public function rules(): array
    {
        return $this->configurationValues()
            ->keyBy(fn (ConfigurationValue $value) => $value->attribute())
            ->map(fn (ConfigurationValue $value) => $this->deriveRules($value))
            ->toArray();
    }

    /**
     * @return Collection<ConfigurationValue>
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

    private function deriveRules(ConfigurationValue $value): array
    {
        return array_filter([
            $value->nullable() ? 'nullable' : 'required',
        ]);
    }
}
