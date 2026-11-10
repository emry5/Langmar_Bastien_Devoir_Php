
CREATE DATABASE IF NOT EXISTS touche_pas_au_klaxon
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE touche_pas_au_klaxon;

CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS agences (
    id_agence INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    villes VARCHAR(150) NOT NULL UNIQUE
) ENGINE=InnoDB;



CREATE TABLE IF NOT EXISTS trajets (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    depart_id INT UNSIGNED NOT NULL,
    arrivee_id INT UNSIGNED NOT NULL,
    date_depart DATE NOT NULL,
    heure_depart TIME NOT NULL,
    date_arrivee DATE NOT NULL,
    heure_arrivee TIME NOT NULL,
    places_totales INT NOT NULL,
    places_disponibles INT NOT NULL,

    CONSTRAINT fk_trajets_utilisateurs
        FOREIGN KEY (utilisateur_id)
        REFERENCES utilisateurs(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_trajets_depart
        FOREIGN KEY (depart_id)
        REFERENCES agences(id_agence),

    CONSTRAINT fk_trajets_arrivee
        FOREIGN KEY (arrivee_id)
        REFERENCES agences(id_agence)

) ENGINE=InnoDB;



CREATE OR REPLACE VIEW vue_trajets AS
SELECT
    t.id AS trajet_id,
    t.depart_id,
    dep.villes AS depart,
    t.date_depart,
    t.heure_depart,
    t.arrivee_id,
    arr.villes AS arrivee,
    t.date_arrivee,
    t.heure_arrivee,
    t.places_totales,
    t.places_disponibles,
    u.id AS utilisateurs_id,
    u.nom,
    u.prenom,
    u.telephone,
    u.email
FROM trajets t
INNER JOIN agences dep ON t.depart_id = dep.id_agence
INNER JOIN agences arr ON t.arrivee_id = arr.id_agence
INNER JOIN utilisateurs u ON t.utilisateur_id = u.id;
