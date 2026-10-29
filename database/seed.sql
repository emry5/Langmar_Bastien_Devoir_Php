INSERT INTO utilisateurs (nom, prenom, telephone, email)
VALUES 
    ('Martin', 'Alexandre','0612345678','alexandre.martin@email.fr'),
    ('Dubois', 'Sophie','0698765432','sophie.dubois@email.fr'),
    ('Bernard', 'Julien', '0622446688', 'julien.bernard@email.fr'),
    ('Moreau', 'Camille', '0611223344', 'camille.moreau@email.fr'),
    ('Lefèvre', 'Lucie', '0777889900' , 'lucie.lefevre@email.fr'),
    ('Leroy', 'Thomas', '0655443322', 'thomas.leroy@email.fr'),
    ('Roux', 'Chloé', '0633221199', 'chloe.roux@email.fr'),
    ('Petit', 'Maxime', '0766778899', 'maxime.petit@email.fr'),
    ('Garnier', 'Laura', '0688776655', 'laura.garnier@email.fr'),
    ('Dupuis', 'Antoine', '0744556677', 'antoine.dupuis@email.fr'),
    ('Lefebvre', 'Emma', '0699887766', 'emma.lefebvre@email.fr'),
    ('Fontaine', 'Louis', '0655667788', 'louis.fontaine@email.fr'),
    ('Chevalier', 'Clara', '0788990011', 'clara.chevalier@email.fr'),
    ('Robin', 'Nicolas', '0644332211', 'nicolas.robin@email.fr'),
    ('Gauthier', 'Marine', '0677889922', 'marine.gauthier@email.fr'),
    ('Fournier', 'Pierre', '0722334455', 'pierre.fournier@email.fr'),
    ('Girard', 'Sarah', '0688665544', 'sarah.girard@email.fr'),
    ('Lambert', 'Hugo', '0611223366', 'hugo.lambert@email.fr'),
    ('Masson', 'Julie', '0733445566', 'julie.masson@email.fr'),
    ('Henry', 'Arthur', '0666554433', 'arthur.henry@email.fr');

SELECT nom, prenom, telephone, email 
FROM utilisateurs; 

INSERT INTO agences(id_agence, villes) VALUES 
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

INSERT INTO trajets (
    depart, 
    date_depart, 
    heure_depart, 
    arrivee, 
    date_arrivee, 
    heure_arrivee, 
    places_disponibles

) VALUES
    VALUES
        (1, '2026-11-01', '08:00:00', 2, '12:30:00', 12),
        (1, '2026-11-01', '09:15:00', 10, '11:45:00', 8),
        (2, '2026-11-01', '07:30:00', 3, '10:45:00', 10),
        (3, '2026-11-01', '09:00:00', 5, '11:30:00', 9),
        (4, '2026-11-01', '08:00:00', 9, '10:30:00', 5),
        (6, '2026-11-01', '07:45:00', 11, '09:15:00', 6),
        (5, '2026-11-02', '08:00:00', 2, '12:00:00', 9);




