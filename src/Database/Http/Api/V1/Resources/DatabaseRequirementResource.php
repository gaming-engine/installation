<?php

namespace GamingEngine\Installation\Database\Http\Api\V1\Resources;

use GamingEngine\Installation\Database\Requirements\DatabaseConfigurationRequirements;
use GamingEngine\Installation\Database\Steps\DatabaseRequirementsStep;
use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\EnvironmentConfigurationResource;
use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\RequirementResource;
use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;
use GamingEngine\Installation\Requirements\Requirement;
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
            'configurations' => EnvironmentConfigurationResource::collection(
                $this->configurationValues()
                    ->keyBy(
                        fn (EnvironmentConfigurationValue $configurationValue) => $configurationValue->attribute()
                    )
            ),
            'resources' => __('gaming-engine:installation::requirements.database'),
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
     * @return Collection<EnvironmentConfigurationValue>
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
