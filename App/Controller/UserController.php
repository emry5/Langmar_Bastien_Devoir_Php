<?php

class UserController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    // Connexion d'un utilisateur
    public function connexion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {

                $erreur = "Veuillez renseigner votre adresse e-mail et votre mot de passe.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $erreur = "Veuillez saisir une adresse e-mail valide.";
            } else {

                $user = $this->userModel->getUserByEmail($email);

                if (
                    $user &&
                    password_verify($password, $user['mot_de_passe'])
                ) {

                    session_regenerate_id(true);

                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_prenom'] = $user['prenom'];
                    $_SESSION['user_nom'] = $user['nom'];
                    $_SESSION['user_email'] = $user['email'];

                    header('Location: index.php?page=user');
                    exit;
                } else {

                    $erreur = "Adresse e-mail ou mot de passe incorrect.";
                }
            }
        }

        require __DIR__ . '/../../templates/components/formulaire.php';
    }

    // Afficher la page de l'utilisateur connecté
    public function afficherEspaceUtilisateur()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {

            header('Location: index.php?page=formulaire');
            exit;
        }

        require __DIR__ . '/../../templates/home/user.php';
    }

    // Déconnexion
    public function deconnexion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        header('Location: index.php?page=home');
        exit;
    }
}
