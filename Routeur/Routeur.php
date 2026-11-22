
<?php

$page = $_GET['page'] ?? 'home';

switch ($page) {

    // Accueil des visiteurs
    case 'home':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new TrajetController($pdo);
        $controller->afficherTrajets();

        break;

    // Formulaire de connexion
    case 'formulaire':

        require __DIR__ . '/../templates/components/formulaire.php';

        break;

    // Traitement de la connexion
    case 'connexion':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new UserController($pdo);
        $controller->connexion();

        break;

    // Accueil des utilisateurs connectés
    case 'user':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new TrajetController($pdo);
        $controller->afficherTrajetsUtilisateur();

        break;

    // Détails d'un trajet
    case 'details_trajet':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new TrajetController($pdo);
        $controller->afficherDetailsTrajet();

        break;

    // Créer un trajet
    case 'creer_trajet':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new TrajetController($pdo);
        $controller->creerTrajet();

        break;

    // Modifier un trajet
    case 'modifier_trajet':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new TrajetController($pdo);
        $controller->modifierTrajet();

        break;

    // Supprimer un trajet
    case 'supprimer_trajet':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new TrajetController($pdo);
        $controller->supprimerTrajet();

        break;

    // Déconnexion
    case 'deconnexion':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new UserController($pdo);
        $controller->deconnexion();

        break;

    default:

        http_response_code(404);
        echo "Page introuvable.";

        break;
}
