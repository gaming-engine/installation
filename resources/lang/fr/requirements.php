<?php
return [
    "account" => [
        "button" => "sauvegarder",
        "configuration" => [
            "description" => "Configurez les détails du compte par défaut.",
            "email" => [
                "description" => "Quelle est l'adresse électronique du compte administrateur par défaut ?",
                "name" => "Adresse électronique",
            ],
            "name" => "Details du compte",
            "password" => [
                "description" => "Quel est le mot de passe du compte administrateur par défaut ?",
                "name" => "Mot de passe",
            ],
            "username" => [
                "description" => "Quel est le nom d'utilisateur du compte administrateur par défaut ?",
                "name" => "Nom d'utilisateur",
            ],
        ],
    ],
    "database" => [
        "button" => "Connexion d'essai",
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
                "warning" => "Bien que cela ne soit pas obligatoire, il est fortement conseillé de disposer d'un mot de passe pour votre compte de base de données.",
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
        "description" => "Afin de faire fonctionner le site, une base de données est nécessaire pour stocker toutes les informations.",
        "name" => "Exigences relatives aux bases de données",
    ],
    "server" => [
        "button" => "Rafraîchir",
        "description" => "Ce sont les principales exigences que votre serveur doit avoir pour que le moteur de jeu fonctionne correctement.",
        "file" => [
            "description" => "Décrit tous les fichiers (et les autorisations correspondantes) nécessaires à l'exécution de l'application.",
            "existence" => ["message" => ":name le fichier doit exister (:path)."],
            "name" => "Exigences relatives aux fichiers",
            "paths" => ["environment" => "Environnement"],
            "writable" => ["message" => ":name le fichier doit être accessible en écriture (:path)."],
        ],
        "folder" => [
            "description" => "Décrit tous les dossiers nécessaires au bon fonctionnement de l'application.",
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
            "description" => "Vérifie les exigences PHP de l'application.",
            "extension" => ["message" => "L'extension PHP \":extension\" doit être installée."],
            "name" => "Configuration requise pour PHP (version actuelle : :version)",
            "version" => ["message" => "La version PHP doit être :version ou supérieure."],
        ],
    ],
    "settings" => [
        "date" => [
            "date-format" => [
                "description" => "Comment voulez-vous que les dates soient affichées dans l'application ?",
                "name" => "Format de la date",
            ],
            "description" => "Définissez comment le jeu va gérer l'affichage des dates.",
            "name" => "Paramètres de la date",
            "time-format" => [
                "description" => "Comment voulez-vous que les heures de l'application soient affichées ?",
                "name" => "Format de l'heure",
            ],
            "timezone" => [
                "description" => "Dans quel fuseau horaire souhaitez-vous que l'application fonctionne ?",
                "name" => "Fuseau horaire",
            ],
        ],
        "description" => "Personnalisez votre site",
        "language" => [
            "button" => "Sélectionnez une langue",
            "description" => "Dans quelle langue souhaitez-vous que la langue principale de votre site soit utilisée ?",
            "en" => ["name" => "Anglais"],
            "es" => ["name" => "Espagnol"],
            "fr" => ["name" => "français"],
            "locale" => [
                "description" => "Veuillez noter : tous les plugins peuvent ne pas être implémentés dans la langue spécifiée. S'ils ne le sont pas, l'anglais sera par défaut.",
                "name" => "Sélectionnez une langue",
            ],
            "name" => "Langue",
        ],
        "name" => "Paramètres",
    ],
];
