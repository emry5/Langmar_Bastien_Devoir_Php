
<?php

class AdminModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Récupérer un administrateur par son adresse e-mail
    public function getAdminByEmail($email)
    {
        $sql = "SELECT * FROM administrateur WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les utilisateurs
    public function getAllUtilisateurs()
    {
        $sql = "SELECT * FROM utilisateurs ORDER BY id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer toutes les agences
    public function getAllAgences()
    {
        $sql = "SELECT * FROM agences ORDER BY villes ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Créer une agence
    public function creerAgence($ville)
    {
        $sql = "INSERT INTO agences (villes) VALUES (:ville)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'ville' => $ville
        ]);
    }

    // Récupérer une agence par son identifiant
    public function getAgenceById($id)
    {
        $sql = "SELECT * FROM agences WHERE id_agence = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Modifier une agence
    public function modifierAgence($id, $ville)
    {
        $sql = "UPDATE agences
                SET villes = :ville
                WHERE id_agence = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'ville' => $ville,
            'id' => $id
        ]);
    }

    // Supprimer une agence
    public function supprimerAgence($id)
    {
        // Ne pas supprimer une agence utilisée dans un trajet
        $sql = "DELETE FROM agences
                WHERE id_agence = :id
                AND NOT EXISTS (
                    SELECT 1 FROM trajets
                    WHERE depart_id = :id_depart
                    OR arrivee_id = :id_arrivee
                )";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id,
            'id_depart' => $id,
            'id_arrivee' => $id
        ]);

        return $stmt->rowCount() > 0;
    }

    // Récupérer tous les trajets
    public function getAllTrajets()
    {
        $sql = "SELECT * FROM vue_trajets ORDER BY date_depart ASC, heure_depart DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Supprimer un trajet
    public function supprimerTrajet($id)
    {
        $sql = "DELETE FROM trajets WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->rowCount() > 0;
    }
}
