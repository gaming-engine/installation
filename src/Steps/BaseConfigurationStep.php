<?php

namespace GamingEngine\Installation\Steps;

use GamingEngine\Installation\Steps\ConfigurationRequirements\ConfigurationValue;
use Illuminate\Support\Facades\Storage;

abstract class BaseConfigurationStep extends BaseStep implements Step, ConfigurationStep
{
    /**
     * @var ConfigurationValue[]
     */
    protected array $overrides = [];

    public function __construct()
    {
        if (Storage::exists($file = $this->overrideFile())) {
            $this->override(
                unserialize(
                    base64_decode(
                        Storage::get($file)
                    )
                )
            );
        }
    }

    private function overrideFile(): string
    {
        return 'installation/' . md5(static::class);
    }

    public function override(array $overrides)
    {
        $this->overrides = $overrides;

        Storage::put(
            $this->overrideFile(),
            base64_encode(serialize($overrides))
        );
    }

    public function identifier(): string
    {
        return 'configuration';
    }

    public function overrides(): array
    {
        return $this->overrides;
    }
}
