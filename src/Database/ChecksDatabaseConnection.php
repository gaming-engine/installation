<?php

namespace GamingEngine\Installation\Database;

use GamingEngine\Installation\Models\Database\DatabaseConfiguration;

interface ChecksDatabaseConnection
{
    public function test(DatabaseConfiguration $configuration): bool;
}
