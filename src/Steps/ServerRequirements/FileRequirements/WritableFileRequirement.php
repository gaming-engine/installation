<?php

namespace GamingEngine\Installation\Steps\ServerRequirements\FileRequirements;

use GamingEngine\Installation\Steps\RequirementDetail;
use Illuminate\Support\Facades\File;

class WritableFileRequirement implements RequirementDetail
{
    private string $pathName;
    private string $path;

    public function __construct(string $pathName, string $path)
    {
        $this->pathName = $pathName;
        $this->path = $path;
    }

    public function description(): string
    {
        return __(
            'gaming-engine:installation::requirements.server.file.writable.message',
            [
                'name' => $this->pathName,
                'path' => $this->path,
            ]
        );
    }

    public function check(): bool
    {
        return File::isWritable($this->path);
    }
}
