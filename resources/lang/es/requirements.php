<?php
return [
    "account" => [
        "button" => "Guardar",
        "configuration" => [
            "description" => "Configurar los datos de la cuenta por defecto.",
            "email" => [
                "description" => "¿Cuál es la dirección de correo electrónico de la cuenta de administrador por defecto?",
                "name" => "Dirección de correo electrónico",
            ],
            "name" => "Detalles de la cuenta",
            "password" => [
                "description" => "¿Cuál es la contraseña de la cuenta de administrador por defecto?",
                "name" => "Contraseña",
            ],
            "username" => [
                "description" => "¿Cuál es el nombre de usuario de la cuenta de administrador por defecto?",
                "name" => "Nombre de usuario",
            ],
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
        "date" => [
            "date-format" => [
                "description" => "¿Cómo quiere que se muestren las fechas en la aplicación?",
                "name" => "Formato de la fecha",
            ],
            "description" => "Definir cómo el juego tratará la visualización de las fechas.",
            "name" => "Configuración de la fecha",
            "time-format" => [
                "description" => "¿Cómo quiere que se muestren los tiempos en la aplicación?",
                "name" => "Formato de Tiempo",
            ],
            "timezone" => [
                "description" => "¿En qué zona horaria desea que se ejecute la aplicación?",
                "name" => "Zona horaria",
            ],
        ],
        "description" => "Personalice su sitio web",
        "language" => [
            "button" => "Seleccione el idioma",
            "description" => "¿En qué idioma le gustaría que estuviera la página web?",
            "en" => ["name" => "Inglés"],
            "es" => ["name" => "español"],
            "fr" => ["name" => "francés"],
            "locale" => [
                "description" => "Nota: es posible que no todos los complementos se implementen en el idioma especificado. Si no es así, se utilizará de forma predeterminada en inglés.",
                "name" => "Seleccione un idioma",
            ],
            "name" => "idioma",
        ],
        "name" => "Ajustes",
    ],
];
