<?php

namespace GamingEngine\Installation\Steps;

use Illuminate\Support\Facades\Storage;

abstract class BaseConfigurationStep extends BaseStep implements ConfigurationStep
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

    public function override(array $overrides)
    {
        $this->overrides = $overrides;

        Storage::put(
            $this->overrideFile(),
            base64_encode(serialize($overrides))
        );
    }

    public function overrides(): array
    {
        return $this->overrides;
    }

    private function overrideFile(): string
    {
        return 'installation/' . md5(static::class);
    }
}
