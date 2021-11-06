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
            'title' => $this->resource->title(),
            'is_complete' => $this->resource->isComplete(),
            'apply' => route(
                "api.v1.installation.{$this->resource->identifier()}.requirements.apply"
            ),
        ];
    }
}
