<?php

namespace GamingEngine\Installation\Settings\Requirements;

use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LanguageConfigurationValue extends EnvironmentConfigurationValue
{
    public function name(): string
    {
        return (string)__("gaming-engine:installation::requirements.settings.language.{$this->attribute}.title");
    }

    public function description(): string
    {
        return (string)__("gaming-engine:installation::requirements.settings.language.{$this->attribute}.description");
    }

    public function available(): array
    {
        return collect(File::directories(__DIR__ . '/../../../resources/lang'))
            ->transform(function (string $folder) {
                return Str::afterLast($folder, '/');
            })->toArray();
    }
}
