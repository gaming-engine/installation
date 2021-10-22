<?php

namespace GamingEngine\Installation\Database\Exceptions;

use Exception;

class PublishException extends Exception
{
    public function __construct(string $message = "")
    {
        parent::__construct(
            (string)__('gaming-engine:installation::exceptions.database.publish', [
                'message' => $message,
            ])
        );
    }
}
