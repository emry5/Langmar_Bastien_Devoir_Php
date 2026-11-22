
<?php

class AdminController
{
    private $adminModel;

    public function __construct($db)
    {
        $this->adminModel = new AdminModel($db);
    }

    /* Vérifier les identifiants administrateur */
    public function verifierConnexion($email, $motDePasse)
    {
        $administrateur = $this->adminModel->getAdminByEmail($email);

        if (
            !$administrateur ||
            !password_verify($motDePasse, $administrateur['mot_de_passe'])
        ) {
            return false;
        }

        return $administrateur;
    }

    /* Connexion au compte administrateur */
    public function connecter($administrateur)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_regenerate_id(true);

        $_SESSION['admin_id'] = $administrateur['id'];
        $_SESSION['admin_nom'] = $administrateur['nom'];
        $_SESSION['admin_prenom'] = $administrateur['prenom'];
        $_SESSION['admin_email'] = $administrateur['email'];

        header('Location: index.php?page=admin');
        exit;
    }

    /* Connexion administrateur */
    public function connexion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

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
            header('Location: index.php?page=formulaire');
            exit;
        }

        $administrateur = $this->verifierConnexion($email, $motDePasse);

        if (!$administrateur) {
            echo "Adresse e-mail ou mot de passe incorrect.";
            exit;
        }

        $this->connecter($administrateur);
    }

    /* Vérifier que l'administrateur est connecté */
    private function verifierAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin_id'])) {
            header('Location: index.php?page=formulaire');
            exit;
        }
    }

    /* Rediriger vers une section du tableau de bord */
    private function redirigerDashboard($section)
    {
        header('Location: index.php?page=admin&section=' . $section);
        exit;
    }

    /* Afficher le tableau de bord administrateur */
    public function afficherDashboard()
    {
        $this->verifierAdmin();

        $section = $_GET['section'] ?? 'utilisateurs';

        $utilisateurs = [];
        $agences = [];
        $trajets = [];

        if ($section === 'utilisateurs') {

            $utilisateurs = $this->adminModel->getAllUtilisateurs();
        } elseif ($section === 'agences') {

            $agences = $this->adminModel->getAllAgences();
        } elseif ($section === 'trajets') {

            $trajets = $this->adminModel->getAllTrajets();
        } else {

            $section = 'utilisateurs';
            $utilisateurs = $this->adminModel->getAllUtilisateurs();
        }

        $erreur = $_SESSION['admin_erreur'] ?? '';
        unset($_SESSION['admin_erreur']);

        $message = $_SESSION['admin_message'] ?? '';
        unset($_SESSION['admin_message']);

        require __DIR__ . '/../../templates/admin/Dashboard.php';
    }

    /* Créer une agence */
    public function creerAgence()
    {
        $this->verifierAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirigerDashboard('agences');
        }

        $ville = trim($_POST['villes'] ?? '');

        if ($ville === '' || mb_strlen($ville) > 150) {
            $_SESSION['admin_erreur'] = "Veuillez saisir un nom de ville valide.";
            $this->redirigerDashboard('agences');
        }

        try {

            $this->adminModel->creerAgence($ville);

            $_SESSION['admin_message'] = "L'agence a bien été créée.";
        } catch (PDOException $e) {

            $_SESSION['admin_erreur'] = "Cette agence existe déjà ou une erreur est survenue.";
        }

        $this->redirigerDashboard('agences');
    }

    /* Modifier une agence */
    public function modifierAgence()
    {
        $this->verifierAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirigerDashboard('agences');
        }

        $id = $_POST['id_agence'] ?? '';
        $ville = trim($_POST['villes'] ?? '');

        if (
            !ctype_digit((string) $id) ||
            (int) $id < 1 ||
            $ville === '' ||
            mb_strlen($ville) > 150
        ) {
            $_SESSION['admin_erreur'] = "Les informations de l'agence sont invalides.";
            $this->redirigerDashboard('agences');
        }

        $agence = $this->adminModel->getAgenceById((int) $id);

        if (!$agence) {
            $_SESSION['admin_erreur'] = "Cette agence n'existe pas.";
            $this->redirigerDashboard('agences');
        }

        try {

            $this->adminModel->modifierAgence((int) $id, $ville);

            $_SESSION['admin_message'] = "L'agence a bien été modifiée.";
        } catch (PDOException $e) {

            $_SESSION['admin_erreur'] = "Cette ville existe déjà ou une erreur est survenue.";
        }

        $this->redirigerDashboard('agences');
    }

    /* Supprimer une agence */
    public function supprimerAgence()
    {
        $this->verifierAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirigerDashboard('agences');
        }

        $id = $_POST['id_agence'] ?? '';

        if (!ctype_digit((string) $id) || (int) $id < 1) {
            $_SESSION['admin_erreur'] = "Identifiant d'agence invalide.";
            $this->redirigerDashboard('agences');
        }

        $suppression = $this->adminModel->supprimerAgence((int) $id);

        if ($suppression) {
            $_SESSION['admin_message'] = "L'agence a bien été supprimée.";
        } else {
            $_SESSION['admin_erreur'] = "Impossible de supprimer cette agence : elle est peut-être utilisée dans un trajet.";
        }

        $this->redirigerDashboard('agences');
    }

    /* Supprimer un trajet */
    public function supprimerTrajet()
    {
        $this->verifierAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirigerDashboard('trajets');
        }

        $id = $_POST['id'] ?? '';

        if (!ctype_digit((string) $id) || (int) $id < 1) {
            $_SESSION['admin_erreur'] = "Identifiant de trajet invalide.";
            $this->redirigerDashboard('trajets');
        }

        $suppression = $this->adminModel->supprimerTrajet((int) $id);

        if ($suppression) {
            $_SESSION['admin_message'] = "Le trajet a bien été supprimé.";
        } else {
            $_SESSION['admin_erreur'] = "Ce trajet n'existe pas ou n'a pas pu être supprimé.";
        }

        $this->redirigerDashboard('trajets');
    }

    /* Déconnexion administrateur */
    public function deconnexion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset(
            $_SESSION['admin_id'],
            $_SESSION['admin_nom'],
            $_SESSION['admin_prenom'],
            $_SESSION['admin_email']
        );

        session_regenerate_id(true);

        header('Location: index.php?page=home');
        exit;
    }
}
