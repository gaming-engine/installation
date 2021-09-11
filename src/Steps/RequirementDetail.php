<?php

namespace GamingEngine\Installation\Steps;

interface RequirementDetail
{
    public function description(): string;

    public function check(): bool;
}
