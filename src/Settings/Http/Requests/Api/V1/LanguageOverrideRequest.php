<?php

namespace GamingEngine\Installation\Settings\Http\Requests\Api\V1;

use GamingEngine\Installation\Requirements\Configuration\ConfigurationValue;
use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;
use GamingEngine\Installation\Settings\Requirements\LanguageConfigurationValue;
use GamingEngine\Installation\Settings\Requirements\LanguageSettings;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class LanguageOverrideRequest extends FormRequest
{
    public function rules(): array
    {
        return $this->configurationValues()
            ->keyBy(fn (EnvironmentConfigurationValue $value) => $value->attribute())
            ->map(fn (LanguageConfigurationValue $value) => $this->deriveRules($value))
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

    private function requirements(): LanguageSettings
    {
        return app(LanguageSettings::class);
    }

    private function deriveRules(LanguageConfigurationValue $value): array
    {
        return [
            $value->nullable() ? 'nullable' : 'required',
            Rule::in($value->available()),
        ];
    }
}
