
<?php

class HomeController
{
    private $trajetModel;

    public function __construct($db)
    {
        $this->trajetModel = new Trajet($db);
    }
    /*Afficher la page d'accueil des visiteurs*/
    /* Afficher les trajets pour les visiteurs */
    public function afficherAccueil()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $trajets = $this->trajetModel->getAllTrajets();

        require __DIR__ . '/../../templates/home/Visitor.php';
    }
    /*Afficher la page d'accueil des utilisateurs*/
    /* Afficher les trajets pour les utilisateurs connectés */
    public function afficherAccueilUtilisateur()
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
}
