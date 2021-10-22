<?php
return [
    "account" => [
        "button" => "Save",
        "configuration" => [
            "description" => "Set up the default account details.",
            "email" => [
                "description" => "What is the email address for the default administrator account?",
                "title" => "Email Address",
            ],
            "name" => [
                "description" => "What is the username for the default administrator account?",
                "title" => "Username",
            ],
            "password" => [
                "description" => "What is the password for the default administrator account?",
                "title" => "Password",
            ],
            "title" => "Account Details",
        ],
    ],
    "database" => [
        "button" => "Test Connection",
        "configuration" => [
            "database-name" => ["description" => "The name of your database", "title" => "Database Name"],
            "description" => "Settings for your database connection.",
            "engine" => [
                "description" => "The database engine that you are using (normally mysql).",
                "title" => "Database Engine",
            ],
            "host" => [
                "description" => "The hostname that you use to connect to your database (normally localhost).",
                "title" => "Database Host",
            ],
            "password" => [
                "description" => "The password used to connect to the database.",
                "title" => "Database Password",
                "warning" => "Although not mandatory, it is strongly suggested that you have a password for your database account.",
            ],
            "title" => "Database Settings",
            "username" => [
                "description" => "The username used to connect to the database.",
                "title" => "Database Username",
            ],
        ],
        "connection" => [
            "description" => "Unable to connect to the database with the specified credentials.",
            "title" => "Database Connectivity",
        ],
        "description" => "In order to run the site, a database is required to store all of the information.",
        "title" => "Database Requirements",
    ],
    "finalize" => [
        "button" => "Install",
        "complete" => "Congratulations! The installation process is now complete!  Click the button below to check it out.",
        "finish" => "Take me to the Game!",
        "title" => "Finalize Installation",
    ],
    "server" => [
        "button" => "Refresh",
        "description" => "These are the main requirements for your server to have in order for the Gaming Engine to work properly.",
        "file" => [
            "description" => "Describes all of the files (and their related permissions) required to run the application.",
            "existence" => ["message" => ":name file must exist (:path)."],
            "paths" => ["environment" => "Environment"],
            "title" => "File Requirements",
            "writable" => ["message" => ":name file must be writable (:path)."],
        ],
        "folder" => [
            "description" => "Describes all of the required folders for the application to run successfully.",
            "existence" => ["message" => ":name folder must exist (:path)."],
            "paths" => [
                "migrations" => "Database Migrations",
                "public-storage" => "Public Storage",
                "storage-link" => "Web Accessible Storage",
            ],
            "title" => "Folder Requirements",
            "writable" => ["message" => ":name folder must be writable (:path)."],
        ],
        "php" => [
            "description" => "Checks for the PHP requirements for the application.",
            "extension" => ["message" => "PHP extension \":extension\" must be installed."],
            "title" => "PHP Requirements (current version: :version)",
            "version" => ["message" => "PHP version must be :version or higher."],
        ],
        "title" => "Server Requirements",
    ],
    "settings" => [
        "date" => [
            "date-format" => [
                "description" => "How would you like the dates in the application to be displayed?",
                "title" => "Date Format",
            ],
            "description" => "Define how the game will deal with the displaying of dates.",
            "time-format" => [
                "description" => "How would you like the times in the application to be displayed?",
                "title" => "Time Format",
            ],
            "timezone" => [
                "description" => "What timezone would you like the application to run in?",
                "title" => "Timezone",
            ],
            "title" => "Date Settings",
        ],
        "description" => "Customize your site",
        "language" => [
            "button" => "Select Language",
            "description" => "What would you like the primary language for your site to be in?",
            "en" => ["name" => "English"],
            "es" => ["name" => "Spanish"],
            "fr" => ["name" => "French"],
            "locale" => [
                "description" => "Please Note: Not all plugins may be implemented in the specified language.  If they are not, it will default to English.",
                "title" => "Select a Language",
            ],
            "title" => "Language",
        ],
        "title" => "Settings",
    ],
];
