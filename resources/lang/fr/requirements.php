<?php
return [
    "database" => [
        "configuration" => [
            "database-name" => [
                "description" => "Le nom de votre base de données",
                "name" => "Nom de la base de données",
            ],
            "description" => "Paramètres de votre connexion à la base de données.",
            "engine" => [
                "description" => "Le type de base de données que vous utilisez (normalement mysql).",
                "name" => "Type de base de données",
            ],
            "host" => [
                "description" => "Le nom d'hôte que vous utilisez pour vous connecter à votre base de données (normalement localhost).",
                "name" => "Hôte de la base de données",
            ],
            "name" => "Paramètres de la base de données",
            "password" => [
                "description" => "Le mot de passe utilisé pour se connecter à la base de données.",
                "name" => "Mot de passe de la base de données",
            ],
            "username" => [
                "description" => "Le nom d'utilisateur utilisé pour se connecter à la base de données.",
                "name" => "Nom d'utilisateur de la base de données",
            ],
        ],
        "connection" => [
            "description" => "S'assure que vous êtes en mesure de vous connecter à la base de données avec les informations d'identification fournies.",
            "name" => "Connectivité des bases de données",
        ],
        "name" => "Exigences relatives aux bases de données",
    ],
    "server" => [
        "file" => [
            "description" => "",
            "existence" => ["message" => ":name le fichier doit exister (:path)."],
            "name" => "Exigences relatives aux fichiers",
            "paths" => ["environment" => "Environnement"],
            "writable" => ["message" => ":name le fichier doit être accessible en écriture (:path)."],
        ],
        "folder" => [
            "description" => "",
            "existence" => ["message" => ":name dossier doit exister (:path)."],
            "name" => "Exigences relatives aux dossiers",
            "paths" => [
                "public-storage" => "Stockage public",
                "storage-link" => "Stockage accessible sur le Web",
            ],
            "writable" => ["message" => " Le dossier:name doit être accessible en écriture (:path)."],
        ],
        "name" => "Exigences du serveur",
        "php" => [
            "description" => "",
            "extension" => ["message" => "L'extension PHP \":extension\" doit être installée."],
            "name" => "Configuration requise pour PHP (version actuelle : :version)",
            "version" => ["message" => "La version PHP doit être :version ou supérieure."],
        ],
    ],
];
