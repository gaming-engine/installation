<?php

namespace GamingEngine\Installation\Http\Resources\Api\V1\Requirements;

use GamingEngine\Installation\Steps\ConfigurationRequirements\ConfigurationValue;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read ConfigurationValue $resource
 */
class ConfigurationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'attribute' => $this->resource->attribute(),
            'name' => $this->resource->name(),
            'description' => $this->resource->description(),
            'value' => $this->resource->value(),
        ];
    }
}
