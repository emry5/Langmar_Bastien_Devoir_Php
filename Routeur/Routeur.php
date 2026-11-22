
<?php

$page = $_GET['page'] ?? 'home';

switch ($page) {

    /* Accueil des visiteurs */
    case 'home':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new HomeController($pdo);
        $controller->afficherAccueil();

        break;

    /* Formulaire de connexion */
    case 'formulaire':

        require __DIR__ . '/../templates/components/Formulaire.php';

        break;

    /* Traitement de la connexion */
    case 'connexion':

        $database = new Database();
        $pdo = $database->getConnection();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=formulaire');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $motDePasse = $_POST['password'] ?? '';

        if (
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            $motDePasse === ''
        ) {
            $erreur = "Veuillez renseigner une adresse e-mail valide et votre mot de passe.";
            require __DIR__ . '/../templates/components/Formulaire.php';
            break;
        }

        /* Vérification dans la table administrateur */
        $adminController = new AdminController($pdo);
        $administrateur = $adminController->verifierConnexion($email, $motDePasse);

        if ($administrateur) {
            $adminController->connecter($administrateur);
        }

        /* Vérification dans la table utilisateurs */
        $userController = new UserController($pdo);
        $user = $userController->verifierConnexion($email, $motDePasse);

        if ($user) {
            $userController->connecter($user);
        }

        /* Erreur si aucun compte ne correspond à la base de données */
        $erreur = "Adresse e-mail ou mot de passe incorrect.";
        require __DIR__ . '/../templates/components/Formulaire.php';

        break;

    /* Accueil des utilisateurs connectés */
    case 'user':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new HomeController($pdo);
        $controller->afficherAccueilUtilisateur();

        break;

    /* Accueil de l'administrateur */
    case 'admin':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new AdminController($pdo);
        $controller->afficherDashboard();

        break;

    /* Détails d'un trajet */
    case 'details_trajet':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new TrajetController($pdo);
        $controller->afficherDetailsTrajet();

        break;

    /* Créer un trajet */
    case 'creer_trajet':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new TrajetController($pdo);
        $controller->creerTrajet();

        break;

    /* Modifier un trajet */
    case 'modifier_trajet':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new TrajetController($pdo);
        $controller->modifierTrajet();

        break;

    /* Supprimer un trajet */
    case 'supprimer_trajet':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new TrajetController($pdo);
        $controller->supprimerTrajet();

        break;

    /* Créer une agence */
    case 'creer_agence':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new AdminController($pdo);
        $controller->creerAgence();

        break;

    /* Modifier une agence */
    case 'modifier_agence':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new AdminController($pdo);
        $controller->modifierAgence();

        break;

    /* Supprimer une agence */
    case 'supprimer_agence':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new AdminController($pdo);
        $controller->supprimerAgence();

        break;

    /* Supprimer un trajet depuis l'espace administrateur */
    case 'admin_supprimer_trajet':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new AdminController($pdo);
        $controller->supprimerTrajet();

        break;

    /* Déconnexion */
    case 'deconnexion':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new UserController($pdo);
        $controller->deconnexion();

        break;

    /* Déconnexion administrateur */
    case 'admin_deconnexion':

        $database = new Database();
        $pdo = $database->getConnection();

        $controller = new AdminController($pdo);
        $controller->deconnexion();

        break;

    /* Page introuvable */
    default:

        http_response_code(404);
        echo "Page introuvable.";

        break;
}
