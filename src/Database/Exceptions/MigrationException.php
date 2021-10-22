<?php

namespace GamingEngine\Installation\Database\Exceptions;

use Exception;

class MigrationException extends Exception
{
    public function __construct(string $message = "")
    {
        parent::__construct(
            (string)__('gaming-engine:installation::exceptions.database.migration', [
                'message' => $message,
            ])
        );
    }
}
