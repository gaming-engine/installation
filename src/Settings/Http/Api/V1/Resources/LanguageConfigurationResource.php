<?php

namespace GamingEngine\Installation\Settings\Http\Api\V1\Resources;

use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\ConfigurationResource;

/**
 * @property-read LanguageResource $resource
 */
class LanguageConfigurationResource extends ConfigurationResource
{
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'available' => $this->resource->available(),
        ]);
    }
}
