<?php
return [
    "account" => [
        "button" => "sauvegarder",
        "configuration" => [
            "description" => "Configurez les détails du compte par défaut.",
            "email" => [
                "description" => "Quelle est l'adresse électronique du compte administrateur par défaut ?",
                "title" => "Adresse électronique",
            ],
            "name" => [
                "description" => "Quel est le nom d'utilisateur du compte administrateur par défaut ?",
                "title" => "Nom d'utilisateur",
            ],
            "password" => [
                "description" => "Quel est le mot de passe du compte administrateur par défaut ?",
                "title" => "Mot de passe",
            ],
            "title" => "Details du compte",
        ],
    ],
    "database" => [
        "button" => "Connexion d'essai",
        "configuration" => [
            "database-name" => [
                "description" => "Le nom de votre base de données",
                "title" => "Nom de la base de données",
            ],
            "description" => "Paramètres de votre connexion à la base de données.",
            "engine" => [
                "description" => "Le type de base de données que vous utilisez (normalement mysql).",
                "title" => "Type de base de données",
            ],
            "host" => [
                "description" => "Le nom d'hôte que vous utilisez pour vous connecter à votre base de données (normalement localhost).",
                "title" => "Hôte de la base de données",
            ],
            "password" => [
                "description" => "Le mot de passe utilisé pour se connecter à la base de données.",
                "title" => "Mot de passe de la base de données",
                "warning" => "Bien que cela ne soit pas obligatoire, il est fortement conseillé de disposer d'un mot de passe pour votre compte de base de données.",
            ],
            "title" => "Paramètres de la base de données",
            "username" => [
                "description" => "Le nom d'utilisateur utilisé pour se connecter à la base de données.",
                "title" => "Nom d'utilisateur de la base de données",
            ],
        ],
        "connection" => [
            "description" => "S'assure que vous êtes en mesure de vous connecter à la base de données avec les informations d'identification fournies.",
            "title" => "Connectivité des bases de données",
        ],
        "description" => "Afin de faire fonctionner le site, une base de données est nécessaire pour stocker toutes les informations.",
        "error" => ["description" => "", "title" => ""],
        "title" => "Exigences relatives aux bases de données",
    ],
    "finalize" => [
        "button" => "Installer",
        "complete" => "Toutes nos félicitations! Le processus d'installation est maintenant terminé ! Cliquez sur le bouton ci-dessous pour le vérifier.",
        "finish" => "Emmenez-moi au jeu !",
        "title" => "Finaliser l'installation",
    ],
    "server" => [
        "button" => "Rafraîchir",
        "description" => "Ce sont les principales exigences que votre serveur doit avoir pour que le moteur de jeu fonctionne correctement.",
        "file" => [
            "description" => "Décrit tous les fichiers (et les autorisations correspondantes) nécessaires à l'exécution de l'application.",
            "existence" => ["message" => ":name le fichier doit exister (:path)."],
            "paths" => ["environment" => "Environnement"],
            "title" => "Exigences relatives aux fichiers",
            "writable" => ["message" => ":name le fichier doit être accessible en écriture (:path)."],
        ],
        "folder" => [
            "description" => "Décrit tous les dossiers nécessaires au bon fonctionnement de l'application.",
            "existence" => ["message" => ":name dossier doit exister (:path)."],
            "paths" => [
                "migrations" => "Migrations de bases de données",
                "public-storage" => "Stockage public",
                "storage-link" => "Stockage accessible sur le Web",
            ],
            "title" => "Exigences relatives aux dossiers",
            "writable" => ["message" => " Le dossier:name doit être accessible en écriture (:path)."],
        ],
        "php" => [
            "description" => "Vérifie les exigences PHP de l'application.",
            "extension" => ["message" => "L'extension PHP \":extension\" doit être installée."],
            "title" => "Configuration requise pour PHP (version actuelle : :version)",
            "version" => ["message" => "La version PHP doit être :version ou supérieure."],
        ],
        "title" => "Exigences du serveur",
    ],
    "settings" => [
        "description" => "Personnalisez votre site",
        "language" => [
            "button" => "Sélectionnez une langue",
            "description" => "Dans quelle langue souhaitez-vous que la langue principale de votre site soit utilisée ?",
            "en" => ["name" => "Anglais"],
            "es" => ["name" => "Espagnol"],
            "fr" => ["name" => "français"],
            "locale" => [
                "description" => "Veuillez noter : tous les plugins peuvent ne pas être implémentés dans la langue spécifiée. S'ils ne le sont pas, l'anglais sera par défaut.",
                "title" => "Sélectionnez une langue",
            ],
            "title" => "Langue",
        ],
        "site" => [
            "description" => "",
            "domain" => ["description" => "", "title" => ""],
            "name" => ["description" => "", "title" => ""],
            "title" => "",
        ],
        "title" => "Paramètres",
    ],
];
