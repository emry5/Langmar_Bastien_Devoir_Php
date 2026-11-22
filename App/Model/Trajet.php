
<?php

class Trajet
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Récupérer tous les trajets avec les informations des conducteurs
    public function getAllTrajets()
    {
        $sql = "SELECT * FROM vue_trajets";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les détails d'un trajet précis
    public function getTrajetById($id)
    {
        $sql = "SELECT * FROM vue_trajets WHERE trajet_id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer un trajet uniquement s'il appartient à l'utilisateur
    public function getTrajetByIdAndUtilisateur($id, $utilisateurId)
    {
        $sql = "SELECT *
                FROM vue_trajets
                WHERE trajet_id = :id
                AND utilisateurs_id = :utilisateur_id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id,
            'utilisateur_id' => $utilisateurId
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer toutes les agences pour les formulaires
    public function getAllAgences()
    {
        $sql = "SELECT id_agence, villes
                FROM agences
                ORDER BY villes";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vérifier qu'une agence existe
    public function agenceExiste($id)
    {
        $sql = "SELECT COUNT(*)
                FROM agences
                WHERE id_agence = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetchColumn() > 0;
    }

    // Créer un nouveau trajet
    public function creerTrajet($utilisateurId, $donnees)
    {
        $sql = "INSERT INTO trajets (
                    utilisateur_id,
                    depart_id,
                    arrivee_id,
                    date_depart,
                    heure_depart,
                    date_arrivee,
                    heure_arrivee,
                    places_totales,
                    places_disponibles
                ) VALUES (
                    :utilisateur_id,
                    :depart_id,
                    :arrivee_id,
                    :date_depart,
                    :heure_depart,
                    :date_arrivee,
                    :heure_arrivee,
                    :places_totales,
                    :places_disponibles
                )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'utilisateur_id' => $utilisateurId,
            'depart_id' => $donnees['depart_id'],
            'arrivee_id' => $donnees['arrivee_id'],
            'date_depart' => $donnees['date_depart'],
            'heure_depart' => $donnees['heure_depart'],
            'date_arrivee' => $donnees['date_arrivee'],
            'heure_arrivee' => $donnees['heure_arrivee'],
            'places_totales' => $donnees['places_totales'],
            'places_disponibles' => $donnees['places_disponibles']
        ]);
    }

    // Modifier un trajet uniquement si l'utilisateur en est propriétaire
    public function modifierTrajet($id, $utilisateurId, $donnees)
    {
        $sql = "UPDATE trajets
                SET
                    depart_id = :depart_id,
                    arrivee_id = :arrivee_id,
                    date_depart = :date_depart,
                    heure_depart = :heure_depart,
                    date_arrivee = :date_arrivee,
                    heure_arrivee = :heure_arrivee,
                    places_totales = :places_totales,
                    places_disponibles = :places_disponibles
                WHERE id = :id
                AND utilisateur_id = :utilisateur_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'depart_id' => $donnees['depart_id'],
            'arrivee_id' => $donnees['arrivee_id'],
            'date_depart' => $donnees['date_depart'],
            'heure_depart' => $donnees['heure_depart'],
            'date_arrivee' => $donnees['date_arrivee'],
            'heure_arrivee' => $donnees['heure_arrivee'],
            'places_totales' => $donnees['places_totales'],
            'places_disponibles' => $donnees['places_disponibles'],
            'id' => $id,
            'utilisateur_id' => $utilisateurId
        ]);
    }

    // Supprimer un trajet uniquement si l'utilisateur en est propriétaire
    public function supprimerTrajet($id, $utilisateurId)
    {
        $sql = "DELETE FROM trajets
                WHERE id = :id
                AND utilisateur_id = :utilisateur_id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id,
            'utilisateur_id' => $utilisateurId
        ]);

        return $stmt->rowCount() > 0;
    }
}
