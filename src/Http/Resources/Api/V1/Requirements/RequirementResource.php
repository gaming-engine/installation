<?php

namespace GamingEngine\Installation\Http\Resources\Api\V1\Requirements;

use GamingEngine\Installation\Steps\Requirement;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Requirement $resource
 */
class RequirementResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->name(),
            'description' => $this->resource->description(),
            'is_complete' => $this->resource->check(),
            'tests' => RequirementDetailResource::collection($this->resource->components()),
        ];
    }
}
