<?php

namespace GamingEngine\Installation\Models\Database;

use JetBrains\PhpStorm\Immutable;

#[Immutable]
class DatabaseConfiguration
{
    public ?string $engine;

    public ?string $host;

    public ?string $name;

    public ?string $username;

    public ?string $password;

    public function __construct(array $values)
    {
        foreach ($values as $key => $value) {
            $this->$key = $value;
        }
    }
}
