<?php

namespace GamingEngine\Installation\Settings\Requirements;

use GamingEngine\Installation\Requirements\Configuration\ConfigurationValue;

class SiteConfigurationValue extends ConfigurationValue
{
    public function title(): string
    {
        return (string)__("gaming-engine:installation::requirements.settings.site.{$this->attribute}.title");
    }

    public function description(): string
    {
        return (string)__("gaming-engine:installation::requirements.settings.site.{$this->attribute}.description");
    }
}
