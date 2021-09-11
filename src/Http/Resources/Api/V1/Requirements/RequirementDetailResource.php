<?php

namespace GamingEngine\Installation\Http\Resources\Api\V1\Requirements;

use GamingEngine\Installation\Steps\RequirementDetail;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read RequirementDetail $resource
 */
class RequirementDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'description' => $this->resource->description(),
            'is_complete' => $this->resource->check(),
        ];
    }
}
