<?php

namespace GamingEngine\Installation\Http\Resources\Api\V1\Requirements;

use GamingEngine\Installation\Requirements\Configuration\ConfigurationValue;
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
            'title' => $this->resource->title(),
            'description' => $this->resource->description(),
            'value' => $this->resource->value(),
            'nullable' => $this->resource->nullable(),
        ];
    }
}
