<?php

namespace GamingEngine\Installation\Steps;

interface ConfigurationStep
{
    public function override(array $overrides);

    public function overrides(): array;
}
