<?php

namespace GamingEngine\Installation\Settings\Http\Requests\Api\V1;

use GamingEngine\Installation\Requirements\Configuration\ConfigurationValue;
use GamingEngine\Installation\Settings\Requirements\SiteConfigurationValue;
use GamingEngine\Installation\Settings\Requirements\SiteDetails;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class SiteDetailsOverrideRequest extends FormRequest
{
    public function rules(): array
    {
        return $this->configurationValues()
            ->keyBy(fn (ConfigurationValue $value) => $value->attribute())
            ->map(fn (SiteConfigurationValue $value) => $this->deriveRules($value))
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

    private function requirements(): SiteDetails
    {
        return app(SiteDetails::class);
    }

    private function deriveRules(SiteConfigurationValue $value): array
    {
        return array_filter([
            $value->nullable() ? 'nullable' : 'required',
        ]);
    }
}
