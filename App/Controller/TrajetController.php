
<?php

class TrajetController
{
    private $trajetModel;

    public function __construct($db)
    {
        $this->trajetModel = new Trajet($db);
    }

    // Afficher les trajets pour les visiteurs
    public function afficherTrajets()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $trajets = $this->trajetModel->getAllTrajets();

        require __DIR__ . '/../../templates/home/visitor.php';
    }

    // Afficher les trajets pour les utilisateurs connectés
    public function afficherTrajetsUtilisateur()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=formulaire');
            exit;
        }

        $trajets = $this->trajetModel->getAllTrajets();

        require __DIR__ . '/../../templates/home/user.php';
    }

    // Récupérer les informations d'un trajet pour la fenêtre modale
    public function afficherDetailsTrajet()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            echo "Accès réservé aux utilisateurs connectés.";
            exit;
        }

        if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
            http_response_code(400);
            echo "Identifiant du trajet invalide.";
            exit;
        }

        $id = (int) $_GET['id'];

        $trajet = $this->trajetModel->getTrajetById($id);

        if (!$trajet) {
            http_response_code(404);
            echo "Trajet introuvable.";
            exit;
        }

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode($trajet, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Afficher et traiter le formulaire de création
    public function creerTrajet()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=formulaire');
            exit;
        }

        $agences = $this->trajetModel->getAllAgences();
        $erreur = '';
        $donnees = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $departId = $_POST['depart_id'] ?? '';
            $arriveeId = $_POST['arrivee_id'] ?? '';
            $dateDepart = $_POST['date_depart'] ?? '';
            $heureDepart = $_POST['heure_depart'] ?? '';
            $dateArrivee = $_POST['date_arrivee'] ?? '';
            $heureArrivee = $_POST['heure_arrivee'] ?? '';
            $placesTotales = $_POST['places_totales'] ?? '';
            $placesDisponibles = $_POST['places_disponibles'] ?? '';

            // Conserver les valeurs saisies en cas d'erreur
            $donnees = [
                'depart_id' => $departId,
                'arrivee_id' => $arriveeId,
                'date_depart' => $dateDepart,
                'heure_depart' => $heureDepart,
                'date_arrivee' => $dateArrivee,
                'heure_arrivee' => $heureArrivee,
                'places_totales' => $placesTotales,
                'places_disponibles' => $placesDisponibles
            ];

            $dateDepartObjet = DateTime::createFromFormat('!Y-m-d', $dateDepart);
            $dateArriveeObjet = DateTime::createFromFormat('!Y-m-d', $dateArrivee);
            $heureDepartObjet = DateTime::createFromFormat('!H:i', $heureDepart);
            $heureArriveeObjet = DateTime::createFromFormat('!H:i', $heureArrivee);

            if (
                !ctype_digit((string) $departId) ||
                !ctype_digit((string) $arriveeId) ||
                !ctype_digit((string) $placesTotales) ||
                !ctype_digit((string) $placesDisponibles)
            ) {
                $erreur = "Veuillez renseigner des valeurs valides.";
            } elseif (
                !$this->trajetModel->agenceExiste((int) $departId) ||
                !$this->trajetModel->agenceExiste((int) $arriveeId)
            ) {
                $erreur = "L'agence sélectionnée n'existe pas.";
            } elseif ((int) $departId === (int) $arriveeId) {
                $erreur = "Le départ et l'arrivée doivent être différents.";
            } elseif (
                (int) $placesTotales < 1 ||
                (int) $placesDisponibles > (int) $placesTotales
            ) {
                $erreur = "Le nombre de places disponibles doit être compris entre 0 et le nombre total de places.";
            } elseif (
                !$dateDepartObjet ||
                $dateDepartObjet->format('Y-m-d') !== $dateDepart ||
                !$dateArriveeObjet ||
                $dateArriveeObjet->format('Y-m-d') !== $dateArrivee ||
                !$heureDepartObjet ||
                $heureDepartObjet->format('H:i') !== $heureDepart ||
                !$heureArriveeObjet ||
                $heureArriveeObjet->format('H:i') !== $heureArrivee
            ) {
                $erreur = "Veuillez renseigner des dates et des heures valides.";
            } elseif (
                $dateArriveeObjet < $dateDepartObjet ||
                (
                    $dateArriveeObjet == $dateDepartObjet &&
                    $heureArriveeObjet <= $heureDepartObjet
                )
            ) {
                $erreur = "La date et l'heure d'arrivée doivent être postérieures au départ.";
            } else {

                $dateHeureDepartObjet = DateTime::createFromFormat(
                    '!Y-m-d H:i',
                    $dateDepart . ' ' . $heureDepart
                );

                if ($dateHeureDepartObjet < new DateTime()) {

                    $erreur = "La date et l'heure de départ ne peuvent pas être dans le passé.";
                } else {

                    $donneesValides = [
                        'depart_id' => (int) $departId,
                        'arrivee_id' => (int) $arriveeId,
                        'date_depart' => $dateDepart,
                        'heure_depart' => $heureDepart,
                        'date_arrivee' => $dateArrivee,
                        'heure_arrivee' => $heureArrivee,
                        'places_totales' => (int) $placesTotales,
                        'places_disponibles' => (int) $placesDisponibles
                    ];

                    $this->trajetModel->creerTrajet(
                        (int) $_SESSION['user_id'],
                        $donneesValides
                    );

                    header('Location: index.php?page=user');
                    exit;
                }
            }
        }

        require __DIR__ . '/../../templates/components/creer_trajet.php';
    }

    // Afficher et traiter le formulaire de modification
    public function modifierTrajet()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=formulaire');
            exit;
        }

        if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
            http_response_code(400);
            echo "Identifiant du trajet invalide.";
            exit;
        }

        $id = (int) $_GET['id'];
        $utilisateurId = (int) $_SESSION['user_id'];

        // Vérifier que le trajet appartient à l'utilisateur connecté
        $trajet = $this->trajetModel->getTrajetByIdAndUtilisateur(
            $id,
            $utilisateurId
        );

        if (!$trajet) {
            http_response_code(403);
            echo "Vous n'êtes pas autorisé à modifier ce trajet.";
            exit;
        }

        $agences = $this->trajetModel->getAllAgences();
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $departId = $_POST['depart_id'] ?? '';
            $arriveeId = $_POST['arrivee_id'] ?? '';
            $dateDepart = $_POST['date_depart'] ?? '';
            $heureDepart = $_POST['heure_depart'] ?? '';
            $dateArrivee = $_POST['date_arrivee'] ?? '';
            $heureArrivee = $_POST['heure_arrivee'] ?? '';
            $placesTotales = $_POST['places_totales'] ?? '';
            $placesDisponibles = $_POST['places_disponibles'] ?? '';

            $dateDepartObjet = DateTime::createFromFormat('!Y-m-d', $dateDepart);
            $dateArriveeObjet = DateTime::createFromFormat('!Y-m-d', $dateArrivee);
            $heureDepartObjet = DateTime::createFromFormat('!H:i', $heureDepart);
            $heureArriveeObjet = DateTime::createFromFormat('!H:i', $heureArrivee);

            if (
                !ctype_digit((string) $departId) ||
                !ctype_digit((string) $arriveeId) ||
                !ctype_digit((string) $placesTotales) ||
                !ctype_digit((string) $placesDisponibles)
            ) {
                $erreur = "Veuillez renseigner des valeurs valides.";
            } elseif (
                !$this->trajetModel->agenceExiste((int) $departId) ||
                !$this->trajetModel->agenceExiste((int) $arriveeId)
            ) {
                $erreur = "L'agence sélectionnée n'existe pas.";
            } elseif ((int) $departId === (int) $arriveeId) {
                $erreur = "Le départ et l'arrivée doivent être différents.";
            } elseif (
                (int) $placesTotales < 1 ||
                (int) $placesDisponibles > (int) $placesTotales
            ) {
                $erreur = "Le nombre de places disponibles doit être compris entre 0 et le nombre total de places.";
            } elseif (
                !$dateDepartObjet ||
                $dateDepartObjet->format('Y-m-d') !== $dateDepart ||
                !$dateArriveeObjet ||
                $dateArriveeObjet->format('Y-m-d') !== $dateArrivee ||
                !$heureDepartObjet ||
                $heureDepartObjet->format('H:i') !== $heureDepart ||
                !$heureArriveeObjet ||
                $heureArriveeObjet->format('H:i') !== $heureArrivee
            ) {
                $erreur = "Veuillez renseigner des dates et des heures valides.";
            } elseif (
                $dateArriveeObjet < $dateDepartObjet ||
                (
                    $dateArriveeObjet == $dateDepartObjet &&
                    $heureArriveeObjet <= $heureDepartObjet
                )
            ) {
                $erreur = "La date et l'heure d'arrivée doivent être postérieures au départ.";
            } else {

                $dateHeureDepartObjet = DateTime::createFromFormat(
                    '!Y-m-d H:i',
                    $dateDepart . ' ' . $heureDepart
                );

                if ($dateHeureDepartObjet < new DateTime()) {

                    $erreur = "La date et l'heure de départ ne peuvent pas être dans le passé.";
                } else {

                    $donnees = [
                        'depart_id' => (int) $departId,
                        'arrivee_id' => (int) $arriveeId,
                        'date_depart' => $dateDepart,
                        'heure_depart' => $heureDepart,
                        'date_arrivee' => $dateArrivee,
                        'heure_arrivee' => $heureArrivee,
                        'places_totales' => (int) $placesTotales,
                        'places_disponibles' => (int) $placesDisponibles
                    ];

                    $this->trajetModel->modifierTrajet(
                        $id,
                        $utilisateurId,
                        $donnees
                    );

                    header('Location: index.php?page=user');
                    exit;
                }
            }
        }

        require __DIR__ . '/../../templates/components/modifier_trajet.php';
    }

    // Supprimer un trajet
    public function supprimerTrajet()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifier que l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=formulaire');
            exit;
        }

        // La suppression doit obligatoirement passer par POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Méthode non autorisée.";
            exit;
        }

        // Vérifier l'identifiant reçu
        if (
            !isset($_POST['id']) ||
            !ctype_digit((string) $_POST['id'])
        ) {
            http_response_code(400);
            echo "Identifiant du trajet invalide.";
            exit;
        }

        $id = (int) $_POST['id'];
        $utilisateurId = (int) $_SESSION['user_id'];

        // Supprimer uniquement si le trajet appartient à l'utilisateur
        $supprime = $this->trajetModel->supprimerTrajet(
            $id,
            $utilisateurId
        );

        if (!$supprime) {
            http_response_code(404);
            echo "Trajet introuvable ou vous n'êtes pas autorisé à le supprimer.";
            exit;
        }

        header('Location: index.php?page=user');
        exit;
    }
}
