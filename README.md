# Langmar_Bastien_Devoir_Php

Touche pas au klaxon

Il s'agit d'une application web de covoiturage développée en PHP sous une architecture MVC (Model, Vue, Controller), avec une base de données MySQL.

L'application permet aux utilisateurs de consulter les trajets proposés, gérer leurs propre trajets et pour les administrateur de gérer les données de la plateforme (trajets, agences, utilisateurs). 

Fonctionnalités

Espace visiteur

• Consulter les trajets disponibles.
• Accéder au formulaire de connexion.

Espace utilisateur

• Se connecter à son compte.
• Consulter les trajets proposés.
• Créer un trajet.
• Modifier ses propres trajets.
• Supprimer ses propres trajets.
• Consulter les détails d’un trajet.

Espace administrateur

• Se connecter à l’espace d’administration.
• Consulter la liste des utilisateurs.
• Consulter et gérer les agences.
• Ajouter, modifier et supprimer des agences.
• Consulter et supprimer des trajets.

Technologies utilisées

• PHP : langage côté serveur.
• MySQL : système de gestion de base de données.
• HTML5 : structure des pages.
• CSS3 / Sass : mise en forme.
• Bootstrap : composants et mise en page.
• JavaScript : interactions et affichage dynamique (fenêtre modale donnant le détail des trajets).
• Bootstrap Icons : icônes.
• Git / GitHub : gestion des versions du projet.

Architecture du projet: 

Devoir-php/
│
├── App/
│   ├── Controller/
│   │   ├── AdminController.php
│   │   ├── HomeController.php
│   │   ├── TrajetController.php
│   │   └── UserController.php
│   │
│   └── Model/
│       ├── AdminModel.php
│       ├── Trajet.php
│       └── UserModel.php
│
├── Core/
│   ├── autoloader.php
│   └── Database.php
│
├── Routeur/
│   └── Routeur.php
│
├── database/
│   ├── create.sql
│   └── seed.sql
│
├── public/
│   ├── assets/
│   │   ├── css/
│   │   └── scss/
│   └── index.php
│
└── templates/


Installation

1. Prérequis

* PHP 8 ou supérieur.
* MySQL ou MariaDB.
* Apache.
* XAMPP.
* Un navigateur web.

2. Récupérer le projet

Cloner le dépôt GitHub :

git clone https://github.com/emry5/Langmar_Bastien_Devoir_Php.git

Placer le dossier du projet dans le répertoire htdocs de XAMPP.

3. Créer la base de données

1. Démarrer Apache et MySQL depuis XAMPP.
2. Ouvrir phpMyAdmin.
3. Exécuter le script database/create.sql.
4. Exécuter ensuite database/seed.sql pour insérer les données initiales.

La base de données utilisée est :

touche_pas_au_klaxon

4. Configurer la connexion

Vérifier les paramètres de connexion à la base de données dans :

Core/Database.php


Adapter si nécessaire l’hôte, le nom de la base de données, l’identifiant et le mot de passe MySQL.

5. Lancer le projet

Ouvrir dans le navigateur :
http://localhost/Devoir-php/public/index.php


    ├── admin/
    ├── components/
    └── home/
