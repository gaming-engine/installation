<?php

namespace GamingEngine\Installation\Requirements;

interface RequirementDetail
{
    public function description(): string;

    public function check(): bool;
}
