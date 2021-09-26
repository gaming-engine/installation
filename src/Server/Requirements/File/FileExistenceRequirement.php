<?php

namespace GamingEngine\Installation\Server\Requirements\File;

use GamingEngine\Installation\Requirements\RequirementDetail;
use Illuminate\Support\Facades\File;

class FileExistenceRequirement implements RequirementDetail
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
            'gaming-engine:installation::requirements.server.file.existence.message',
            [
                'name' => $this->pathName,
                'path' => $this->path,
            ]
        );
    }

    public function check(): bool
    {
        return File::exists($this->path) && File::isFile($this->path);
    }
}
