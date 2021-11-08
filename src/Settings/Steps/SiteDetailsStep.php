<?php

namespace GamingEngine\Installation\Settings\Steps;

use GamingEngine\Core\Configuration\Repositories\ConfigurationRepository;
use GamingEngine\Core\Configuration\SiteConfiguration;
use GamingEngine\Installation\Install\UpdatesEnvironment;
use GamingEngine\Installation\Settings\Requirements\SiteDetails;
use GamingEngine\Installation\Steps\BaseConfigurationStep;
use GamingEngine\StringTools\StringHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SiteDetailsStep extends BaseConfigurationStep
{
    public function __construct(
        private Request $request,
        private UpdatesEnvironment $environmentUpdater,
        private ConfigurationRepository $configurationRepository
    ) {
        parent::__construct();
    }

    public function identifier(): string
    {
        return 'site-details';
    }

    public function title(): string
    {
        return (string)__('gaming-engine:installation::requirements.settings.site.title');
    }

    public function apply(): void
    {
        $this->environmentUpdater->update([
            'APP_URL' => $this->deriveUrl(),
        ], 'site-details');

        $this->configurationRepository->update(
            SiteConfiguration::fromConfiguration(
                $this->configurationRepository->site(),
                [
                    'name' => $this->siteDetails()->siteName(),
                ]
            )
        );
    }

    private function deriveUrl(): string
    {
        return StringHelper::template(
            '{scheme}://{host}',
            [
                'scheme' => $this->request->getScheme(),
                'host' => $this->siteDetails()
                    ->domain(),
            ]
        );
    }

    private function siteDetails(): SiteDetails
    {
        return $this->checks()
            ->first(fn ($check) => $check instanceof SiteDetails);
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
}
