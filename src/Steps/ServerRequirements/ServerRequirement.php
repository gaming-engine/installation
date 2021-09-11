<?php

namespace GamingEngine\Installation\Steps\ServerRequirements;

use GamingEngine\Installation\Steps\Requirement;

interface ServerRequirement
{
    public function name(): string;

    public function status(): bool;

    /**
     * @return Requirement[]
     */
    public function checks(): array;
}
