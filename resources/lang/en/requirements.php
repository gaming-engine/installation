<?php
return [
    "database" => [
        "configuration" => [
            "database-name" => ["description" => "The name of your database", "name" => "Database Name"],
            "description" => "Settings for your database connection.",
            "engine" => [
                "description" => "The database engine that you are using (normally mysql).",
                "name" => "Database Engine",
            ],
            "host" => [
                "description" => "The hostname that you use to connect to your database (normally localhost).",
                "name" => "Database Host",
            ],
            "name" => "Database Settings",
            "password" => [
                "description" => "The password used to connect to the database.",
                "name" => "Database Password",
            ],
            "username" => [
                "description" => "The username used to connect to the database.",
                "name" => "Database Username",
            ],
        ],
        "connection" => [
            "description" => "Unable to connect to the database with the specified credentials.",
            "name" => "Database Connectivity",
        ],
        "name" => "Database Requirements",
    ],
    "server" => [
        "file" => [
            "description" => "Describes all of the files (and their related permissions) required to run the application.",
            "existence" => ["message" => ":name file must exist (:path)."],
            "name" => "File Requirements",
            "paths" => ["environment" => "Environment"],
            "writable" => ["message" => ":name file must be writable (:path)."],
        ],
        "folder" => [
            "description" => "Describes all of the required folders for the application to run successfully.",
            "existence" => ["message" => ":name folder must exist (:path)."],
            "name" => "Folder Requirements",
            "paths" => ["public-storage" => "Public Storage", "storage-link" => "Web Accessible Storage"],
            "writable" => ["message" => ":name folder must be writable (:path)."],
        ],
        "name" => "Server Requirements",
        "php" => [
            "description" => "Checks for the PHP requirements for the application.",
            "extension" => ["message" => "PHP extension \":extension\" must be installed."],
            "name" => "PHP Requirements (current version: :version)",
            "version" => ["message" => "PHP version must be :version or higher."],
        ],
    ],
];
