
-- =====================================================
-- ALIMENTATION DE LA BASE DE DONNÉES
-- TOUCHE PAS AU KLAXON
-- =====================================================

USE touche_pas_au_klaxon;


-- =====================================================
-- 1. INSERTION DES UTILISATEURS
-- =====================================================

INSERT INTO utilisateurs (
    nom,
    prenom,
    telephone,
    email,
    mot_de_passe
)
VALUES
    ('Martin', 'Alexandre', '0612345678', 'alexandre.martin@email.fr', 'M0t2P4s$3'),
    ('Dubois', 'Sophie', '0698765432', 'sophie.dubois@email.fr', 'M0tD3P4553*'),
    ('Bernard', 'Julien', '0622446688', 'julien.bernard@email.fr', 'Mot2P4$s3'),
    ('Moreau', 'Camille', '0611223344', 'camille.moreau@email.fr', 'Mot2P4$s3'),
    ('Lefèvre', 'Lucie', '0777889900', 'lucie.lefevre@email.fr', 'Mot2P4$s3'),
    ('Leroy', 'Thomas', '0655443322', 'thomas.leroy@email.fr', 'Mot2P4$s3'),
    ('Roux', 'Chloé', '0633221199', 'chloe.roux@email.fr', 'Mot2P4$s3'),
    ('Petit', 'Maxime', '0766778899', 'maxime.petit@email.fr', 'Mot2P4$s3'),
    ('Garnier', 'Laura', '0688776655', 'laura.garnier@email.fr', 'Mot2P4$s3'),
    ('Dupuis', 'Antoine', '0744556677', 'antoine.dupuis@email.fr', 'Mot2P4$s3'),
    ('Lefebvre', 'Emma', '0699887766', 'emma.lefebvre@email.fr', 'Mot2P4$s3'),
    ('Fontaine', 'Louis', '0655667788', 'louis.fontaine@email.fr', 'Mot2P4$s3'),
    ('Chevalier', 'Clara', '0788990011', 'clara.chevalier@email.fr', 'Mot2P4$s3'),
    ('Robin', 'Nicolas', '0644332211', 'nicolas.robin@email.fr', 'Mot2P4$s3'),
    ('Gauthier', 'Marine', '0677889922', 'marine.gauthier@email.fr', 'Mot2P4$s3'),
    ('Fournier', 'Pierre', '0722334455', 'pierre.fournier@email.fr', 'Mot2P4$s3'),
    ('Girard', 'Sarah', '0688665544', 'sarah.girard@email.fr', 'Mot2P4$s3'),
    ('Lambert', 'Hugo', '0611223366', 'hugo.lambert@email.fr', 'Mot2P4$s3'),
    ('Masson', 'Julie', '0733445566', 'julie.masson@email.fr', 'Mot2P4$s3'),
    ('Henry', 'Arthur', '0666554433', 'arthur.henry@email.fr', 'Mot2P4$s3');


-- =====================================================
-- 2. INSERTION DES AGENCES
-- =====================================================

INSERT INTO agences (
    id_agence,
    villes
)
VALUES
    (1, 'Paris'),
    (2, 'Lyon'),
    (3, 'Marseille'),
    (4, 'Toulouse'),
    (5, 'Nice'),
    (6, 'Nantes'),
    (7, 'Strasbourg'),
    (8, 'Montpellier'),
    (9, 'Bordeaux'),
    (10, 'Lille'),
    (11, 'Rennes'),
    (12, 'Reims');


-- =====================================================
-- 3. INSERTION DES TRAJETS
-- =====================================================

INSERT INTO trajets (
    utilisateur_id,
    depart_id,
    date_depart,
    heure_depart,
    arrivee_id,
    date_arrivee,
    heure_arrivee,
    places_totales,
    places_disponibles
)
VALUES

-- Trajet 1 : Alexandre Martin
(
    (SELECT id FROM utilisateurs
     WHERE email = 'alexandre.martin@email.fr'),
    1,
    '2026-11-01',
    '08:00',
    2,
    '2026-11-01',
    '12:30',
    12,
    12
),

-- Trajet 2 : Sophie Dubois
(
    (SELECT id FROM utilisateurs
     WHERE email = 'sophie.dubois@email.fr'),
    1,
    '2026-11-01',
    '09:15',
    10,
    '2026-11-01',
    '11:45',
    12,
    8
),

-- Trajet 3 : Julien Bernard
(
    (SELECT id FROM utilisateurs
     WHERE email = 'julien.bernard@email.fr'),
    2,
    '2026-11-01',
    '07:30',
    3,
    '2026-11-01',
    '10:45',
    12,
    10
),

-- Trajet 4 : Camille Moreau
(
    (SELECT id FROM utilisateurs
     WHERE email = 'camille.moreau@email.fr'),
    3,
    '2026-11-01',
    '09:00',
    5,
    '2026-11-01',
    '11:30',
    12,
    9
),

-- Trajet 5 : Lucie Lefèvre
(
    (SELECT id FROM utilisateurs
     WHERE email = 'lucie.lefevre@email.fr'),
    4,
    '2026-11-01',
    '08:00',
    9,
    '2026-11-01',
    '10:30',
    12,
    5
),

-- Trajet 6 : Thomas Leroy
(
    (SELECT id FROM utilisateurs
     WHERE email = 'thomas.leroy@email.fr'),
    6,
    '2026-11-01',
    '07:45',
    11,
    '2026-11-01',
    '09:15',
    12,
    6
),

-- Trajet 7 : Chloé Roux
(
    (SELECT id FROM utilisateurs
     WHERE email = 'chloe.roux@email.fr'),
    5,
    '2026-11-02',
    '08:00',
    2,
    '2026-11-02',
    '12:00',
    12,
    9
);


-- =====================================================
-- 4. VÉRIFICATION DES DONNÉES
-- =====================================================

SELECT *
FROM utilisateurs;

SELECT *
FROM agences;

SELECT *
FROM trajets;

-- Vérification des informations qui seront affichées
-- dans la fenêtre modale

SELECT *
FROM vue_trajets;





