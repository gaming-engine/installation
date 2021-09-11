<?php
return [
    "database" => [
        "configuration" => [
            "database-name" => [
                "description" => "El nombre de su base de datos",
                "name" => "Nombre de la base de datos",
            ],
            "description" => "Configuración de la conexión a la base de datos.",
            "engine" => [
                "description" => "El tipo de base de datos que está utilizando (normalmente mysql).",
                "name" => "Tipo de base de datos",
            ],
            "host" => [
                "description" => "El nombre de host que utiliza para conectarse a su base de datos (normalmente localhost).",
                "name" => "Host de la base de datos",
            ],
            "name" => "Configuración de la base de datos",
            "password" => [
                "description" => "La contraseña utilizada para conectarse a la base de datos.",
                "name" => "Contraseña de la base de datos",
            ],
            "username" => [
                "description" => "El nombre de usuario utilizado para conectarse a la base de datos.",
                "name" => "Nombre de usuario de la base de datos",
            ],
        ],
        "connection" => [
            "description" => "Asegura que se puede conectar a la base de datos con las credenciales proporcionadas.",
            "name" => "Conectividad de la base de datos",
        ],
        "name" => "Requisitos de la base de datos",
    ],
    "server" => [
        "file" => [
            "description" => "",
            "existence" => ["message" => " El archivo:name debe existir (:path)."],
            "name" => "Requisitos de los archivos",
            "paths" => ["environment" => "Medio ambiente"],
            "writable" => ["message" => ":name el archivo debe ser escribible (:path)."],
        ],
        "folder" => [
            "description" => "",
            "existence" => ["message" => " La carpeta:name debe existir (:path)."],
            "name" => "Requisitos de la carpeta",
            "paths" => [
                "public-storage" => "Almacenamiento público",
                "storage-link" => "Almacenamiento accesible desde la web",
            ],
            "writable" => ["message" => " La carpeta:name debe ser escribible (:path)."],
        ],
        "name" => "Requisitos del servidor",
        "php" => [
            "description" => "",
            "extension" => ["message" => "La extensión PHP \":extension\" debe estar instalada."],
            "name" => "Requisitos de PHP (versión actual: :version)",
            "version" => ["message" => "La versión de PHP debe ser :version o superior."],
        ],
    ],
];
