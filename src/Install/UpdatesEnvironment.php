<?php

namespace GamingEngine\Installation\Install;

interface UpdatesEnvironment
{
    public function update(array $values, string $backupPrefix = ''): void;
}
