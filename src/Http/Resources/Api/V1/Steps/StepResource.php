<?php

namespace GamingEngine\Installation\Http\Resources\Api\V1\Steps;

use GamingEngine\Installation\Steps\Step;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Step $resource
 */
class StepResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'identifier' => $this->resource->identifier(),
            'name' => $this->resource->name(),
            'is_complete' => $this->resource->isComplete(),
        ];
    }
}
