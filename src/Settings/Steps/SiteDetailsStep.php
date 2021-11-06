<?php

namespace GamingEngine\Installation\Settings\Steps;

use GamingEngine\Installation\Install\UpdatesConfiguration;
use GamingEngine\Installation\Settings\Requirements\SiteDetails;
use GamingEngine\Installation\Steps\BaseConfigurationStep;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SiteDetailsStep extends BaseConfigurationStep
{
    public function __construct(private Request $request, private UpdatesConfiguration $configuration)
    {
        parent::__construct();
    }

    public function identifier(): string
    {
        return 'site-details';
    }

    public function name(): string
    {
        return (string)__('gaming-engine:installation::requirements.settings.site.title');
    }

    /**
     * @inheritDoc
     */
    public function checks(): Collection
    {
        return collect([
            new SiteDetails($this->request, $this->overrides()),
        ]);
    }

    public function apply(): void
    {
    }
}
