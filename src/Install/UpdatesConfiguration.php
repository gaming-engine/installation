<?php

namespace GamingEngine\Installation\Install;

interface UpdatesConfiguration
{
    public function update(array $values, string $backupPrefix = ''): void;
}
