<?php

namespace GamingEngine\Installation\Http\Resources\Api\V1\Requirements;

use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read EnvironmentConfigurationValue $resource
 */
class EnvironmentConfigurationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'attribute' => $this->resource->attribute(),
            'name' => $this->resource->name(),
            'description' => $this->resource->description(),
            'value' => $this->resource->value(),
            'nullable' => $this->resource->nullable(),
        ];
    }
}
