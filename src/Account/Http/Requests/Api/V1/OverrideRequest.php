<?php

namespace GamingEngine\Installation\Account\Http\Requests\Api\V1;

use GamingEngine\Installation\Account\Requirements\AccountConfigurationRequirements;
use GamingEngine\Installation\Requirements\Configuration\ConfigurationValue;
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

    private function requirements(): AccountConfigurationRequirements
    {
        return app(AccountConfigurationRequirements::class);
    }

    private function deriveRules(ConfigurationValue $value): array
    {
        return array_filter([
            $value->nullable() ? 'nullable' : 'required',
        ]);
    }
}
