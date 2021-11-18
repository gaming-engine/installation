<?php
return [
    "account" => [
        "button" => "Guardar",
        "configuration" => [
            "description" => "Configurar los datos de la cuenta por defecto.",
            "email" => [
                "description" => "¿Cuál es la dirección de correo electrónico de la cuenta de administrador por defecto?",
                "title" => "Dirección de correo electrónico",
            ],
            "name" => [
                "description" => "¿Cuál es el nombre de usuario de la cuenta de administrador por defecto?",
                "title" => "Nombre de usuario",
            ],
            "password" => [
                "description" => "¿Cuál es la contraseña de la cuenta de administrador por defecto?",
                "title" => "Contraseña",
            ],
            "title" => "Detalles de la cuenta",
        ],
    ],
    "database" => [
        "button" => "Conexión de prueba",
        "configuration" => [
            "database-name" => [
                "description" => "El nombre de su base de datos",
                "title" => "Nombre de la base de datos",
            ],
            "description" => "Configuración de la conexión a la base de datos.",
            "engine" => [
                "description" => "El tipo de base de datos que está utilizando (normalmente mysql).",
                "title" => "Tipo de base de datos",
            ],
            "host" => [
                "description" => "El nombre de host que utiliza para conectarse a su base de datos (normalmente localhost).",
                "title" => "Host de la base de datos",
            ],
            "password" => [
                "description" => "La contraseña utilizada para conectarse a la base de datos.",
                "title" => "Contraseña de la base de datos",
                "warning" => "Aunque no es obligatorio, se recomienda encarecidamente que tenga una contraseña para su cuenta de la base de datos.",
            ],
            "title" => "Configuración de la base de datos",
            "username" => [
                "description" => "El nombre de usuario utilizado para conectarse a la base de datos.",
                "title" => "Nombre de usuario de la base de datos",
            ],
        ],
        "connection" => [
            "description" => "Asegura que se puede conectar a la base de datos con las credenciales proporcionadas.",
            "title" => "Conectividad de la base de datos",
        ],
        "description" => "Para que el sitio funcione, se necesita una base de datos para almacenar toda la información.",
        "error" => ["description" => "", "title" => ""],
        "title" => "Requisitos de la base de datos",
    ],
    "finalize" => [
        "button" => "instalar",
        "complete" => "¡Felicidades! ¡El proceso de instalación ya está completo! Haga clic en el botón de abajo para comprobarlo.",
        "finish" => "¡Llévame al juego!",
        "title" => "Finalizar la instalación",
    ],
    "server" => [
        "button" => "Actualizar",
        "description" => "Estos son los principales requisitos que debe tener tu servidor para que el Gaming Engine funcione correctamente.",
        "file" => [
            "description" => "Describe todos los archivos (y sus correspondientes permisos) necesarios para ejecutar la aplicación.",
            "existence" => ["message" => " El archivo:name debe existir (:path)."],
            "paths" => ["environment" => "Medio ambiente"],
            "title" => "Requisitos de los archivos",
            "writable" => ["message" => ":name el archivo debe ser escribible (:path)."],
        ],
        "folder" => [
            "description" => "Describe todas las carpetas necesarias para que la aplicación se ejecute correctamente.",
            "existence" => ["message" => " La carpeta:name debe existir (:path)."],
            "paths" => [
                "migrations" => "Migraciones de bases de datos",
                "public-storage" => "Almacenamiento público",
                "storage-link" => "Almacenamiento accesible desde la web",
            ],
            "title" => "Requisitos de la carpeta",
            "writable" => ["message" => " La carpeta:name debe ser escribible (:path)."],
        ],
        "php" => [
            "description" => "Comprueba los requisitos de PHP para la aplicación.",
            "extension" => ["message" => "La extensión PHP \":extension\" debe estar instalada."],
            "title" => "Requisitos de PHP (versión actual: :version)",
            "version" => ["message" => "La versión de PHP debe ser :version o superior."],
        ],
        "title" => "Requisitos del servidor",
    ],
    "settings" => [
        "description" => "Personalice su sitio web",
        "language" => [
            "button" => "Seleccione el idioma",
            "description" => "¿En qué idioma le gustaría que estuviera la página web?",
            "en" => ["name" => "Inglés"],
            "es" => ["name" => "español"],
            "fr" => ["name" => "francés"],
            "locale" => [
                "description" => "Nota: es posible que no todos los complementos se implementen en el idioma especificado. Si no es así, se utilizará de forma predeterminada en inglés.",
                "title" => "Seleccione un idioma",
            ],
            "title" => "idioma",
        ],
        "site" => [
            "description" => "",
            "domain" => ["description" => "", "title" => ""],
            "name" => ["description" => "", "title" => ""],
            "title" => "",
        ],
        "title" => "Ajustes",
    ],
];
