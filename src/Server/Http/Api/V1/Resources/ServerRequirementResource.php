<?php

namespace GamingEngine\Installation\Server\Http\Api\V1\Resources;

use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\RequirementResource;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Server\Steps\ServerRequirementsStep;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property-read ServerRequirementsStep $resource
 */
class ServerRequirementResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'validations' => RequirementResource::collection(
                $this->checks()
                    ->keyBy(fn (Requirement $requirement) => $requirement->identifier())
            ),
            'resources' => __('gaming-engine:installation::requirements.server'),
        ];
    }

    /**
     * @return Collection<Requirement>
     */
    private function checks(): Collection
    {
        return $this->resource->checks();
    }
}
