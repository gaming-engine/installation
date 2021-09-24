<?php
return [
    "account" => [
        "button" => "",
        "configuration" => [
            "description" => "Configurar los datos de la cuenta por defecto.",
            "email" => ["description" => "", "name" => ""],
            "name" => "Detalles de la cuenta",
            "password" => ["description" => "", "name" => ""],
            "username" => ["description" => "", "name" => ""],
        ],
    ],
    "database" => [
        "button" => "Conexión de prueba",
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
                "warning" => "Aunque no es obligatorio, se recomienda encarecidamente que tenga una contraseña para su cuenta de la base de datos.",
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
        "description" => "Para que el sitio funcione, se necesita una base de datos para almacenar toda la información.",
        "name" => "Requisitos de la base de datos",
    ],
    "server" => [
        "button" => "Actualizar",
        "description" => "Estos son los principales requisitos que debe tener tu servidor para que el Gaming Engine funcione correctamente.",
        "file" => [
            "description" => "Describe todos los archivos (y sus correspondientes permisos) necesarios para ejecutar la aplicación.",
            "existence" => ["message" => " El archivo:name debe existir (:path)."],
            "name" => "Requisitos de los archivos",
            "paths" => ["environment" => "Medio ambiente"],
            "writable" => ["message" => ":name el archivo debe ser escribible (:path)."],
        ],
        "folder" => [
            "description" => "Describe todas las carpetas necesarias para que la aplicación se ejecute correctamente.",
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
            "description" => "Comprueba los requisitos de PHP para la aplicación.",
            "extension" => ["message" => "La extensión PHP \":extension\" debe estar instalada."],
            "name" => "Requisitos de PHP (versión actual: :version)",
            "version" => ["message" => "La versión de PHP debe ser :version o superior."],
        ],
    ],
    "settings" => [
        "description" => "Personalice su sitio web",
        "language" => [
            "description" => "¿En qué idioma le gustaría que estuviera la página web?",
            "en" => ["name" => "Inglés"],
            "es" => ["name" => "español"],
            "fr" => ["name" => "francés"],
            "name" => "idioma",
        ],
        "name" => "Ajustes",
    ],
];
