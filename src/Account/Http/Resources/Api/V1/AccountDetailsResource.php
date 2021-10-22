<?php

namespace GamingEngine\Installation\Account\Http\Resources\Api\V1;

use GamingEngine\Installation\Account\Requirements\AccountConfigurationRequirements;
use GamingEngine\Installation\Account\Steps\AccountDetailsStep;
use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\ConfigurationResource;
use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\RequirementResource;
use GamingEngine\Installation\Requirements\Configuration\ConfigurationValue;
use GamingEngine\Installation\Requirements\Requirement;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property-read AccountDetailsStep $resource
 */
class AccountDetailsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'validations' => RequirementResource::collection(
                $this->checks()
                    ->keyBy(fn (Requirement $requirement) => $requirement->identifier())
            ),
            'configurations' => ConfigurationResource::collection(
                $this->configurationValues()
                    ->keyBy(
                        fn (ConfigurationValue $configurationValue) => $configurationValue->attribute()
                    )
            ),
            'resources' => __('gaming-engine:installation::requirements.account'),
        ];
    }

    /**
     * @return Collection<Requirement>
     */
    private function checks(): Collection
    {
        return $this->resource->checks();
    }

    /**
     * @return Collection<ConfigurationValue>
     */
    private function configurationValues(): Collection
    {
        return $this->configurationRequirements()
            ->components();
    }

    private function configurationRequirements(): AccountConfigurationRequirements
    {
        return $this->resource
            ->checks()
            ->first(
                fn (Requirement $requirement) => $requirement instanceof AccountConfigurationRequirements
            );
    }
}
