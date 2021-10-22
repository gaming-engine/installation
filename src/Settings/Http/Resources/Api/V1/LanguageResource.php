<?php

namespace GamingEngine\Installation\Settings\Http\Resources\Api\V1;

use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\RequirementResource;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Settings\Requirements\LanguageSettings;
use GamingEngine\Installation\Settings\Steps\LanguageSettingsStep;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property-read LanguageSettingsStep $resource
 */
class LanguageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'validations' => RequirementResource::collection(
                $this->checks()
                    ->keyBy(fn (Requirement $requirement) => $requirement->identifier())
            ),
            'configurations' => LanguageConfigurationResource::collection(
                $this->language()
                    ->components()
                    ->keyBy(fn ($configuration) => $configuration->attribute())
            ),
            'resources' => __('gaming-engine:installation::requirements.settings.language'),
        ];
    }

    /**
     * @return Collection<Requirement>
     */
    private function checks(): Collection
    {
        return $this->resource->checks();
    }

    private function language(): LanguageSettings
    {
        return $this->checks()
            ->first(fn (Requirement $requirement) => $requirement instanceof LanguageSettings);
    }
}
