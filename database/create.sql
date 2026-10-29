
CREATE DATABASE IF NOT EXISTS touche_pas_au_klaxon
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE touche_pas_au_klaxon;

CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS agences (
    id_agence INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ville VARCHAR(50) NOT NULL UNIQUE
);



CREATE TABLE IF NOT EXISTS trajets (
    id_trajet INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    depart_id INT NOT NULL,
    date_depart DATE NOT NULL,
    heure_depart TIME NOT NULL,
    arrivee_id INT NOT NULL,
    date_arrivee DATE NOT NULL,
    heure_arrivee TIME NOT NULL,
    places_disponibles INT UNSIGNED NOT NULL DEFAULT 0,

    FOREIGN KEY(depart_id)
        REFERENCES agences(id_agence),

    FOREIGN KEY(arrivee_id)
        REFERENCES agences(id_agence),

);

CREATE VIEW vue_trajets AS 
SELECT 
    t.id_trajet,
    dep.ville AS depart,
    t.date_depart,
    t.heure_depart,
    arr.ville AS arrivee,
    t.date_arrivee,
    t.heure_arrivee,
    t.places_disponibles
FROM trajets t 
JOIN agences dep
    ON t.depart_id = dep.id_agence
JOIN agences arr
    ON t.arrivee_id = arr.id_agence;
