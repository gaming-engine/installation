<?php

namespace GamingEngine\Installation\Http\Resources\Api\V1\Requirements;

use GamingEngine\Installation\Requirements\Configuration\ConfigurationValue;
use GamingEngine\Installation\Requirements\Database\DatabaseConfigurationRequirements;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Steps\DatabaseRequirementsStep;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property-read DatabaseRequirementsStep $resource
 */
class DatabaseRequirementResource extends JsonResource
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

    private function configurationRequirements(): DatabaseConfigurationRequirements
    {
        return $this->resource
            ->checks()
            ->first(
                fn (Requirement $requirement) => $requirement instanceof DatabaseConfigurationRequirements
            );
    }
}
