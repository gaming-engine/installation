<?php

namespace GamingEngine\Installation\Install;

use GamingEngine\DotEnv\Writer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ConfigurationUpdater implements UpdatesConfiguration
{
    public function __construct(
        private Writer $writer,
        private string $path = ''
    ) {
        $this->path = empty($path) ? base_path('.env') : $path;
    }

    public function path(): string
    {
        return $this->path;
    }

    /**
     * @param string[] $values
     * @param string $backupPrefix
     * @return void
     */
    public function update(array $values, string $backupPrefix = ''): void
    {
        $this->backupEnvironment($backupPrefix)
            ->updateValues($this->loadExisting(), $values)
            ->write($this->path);

        Artisan::call('config:cache');
    }

    private function write(string $path): self
    {
        $this->writer->write($path);

        return $this;
    }

    private function updateValues(Writer $writer, array $values): self
    {
        foreach ($values as $key => $value) {
            $writer->setValue($key, $value);
        }

        return $this;
    }

    private function backupEnvironment(string $prefix): self
    {
        File::copy(
            $this->path,
            sprintf(
                "%s.%d.%s-orig",
                $this->path,
                time(),
                $prefix
            )
        );

        return $this;
    }

    private function loadExisting(): Writer
    {
        return $this->writer->load($this->path);
    }
}
