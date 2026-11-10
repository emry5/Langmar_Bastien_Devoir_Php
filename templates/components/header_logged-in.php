<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/Devoir-php/public/assets/css/style.css">

    <title>Touche pas au klaxon</title>
</head>

<body>

    <header class="site-header">

        <nav class="navbar navbar-expand-lg container">

            <span class="site-title">
                <a href="/Devoir-php/public/index.php">Touche pas au klaxon</a>
            </span>

            <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3">

                <li class="nav-item">
                    <a class="btn btn-create" href="index.php?page=creer_trajet">
                        Créer un trajet
                    </a>
                </li>

                <li class="nav-item">
                    Bonjour,

                    <?= htmlspecialchars($_SESSION['user_prenom'] ?? 'Utilisateur', ENT_QUOTES, 'UTF-8') ?>

                    <?= htmlspecialchars($_SESSION['user_nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                </li>

                <li class="nav-item">
                    <a class="btn btn-create" href="index.php?page=deconnexion">
                        Déconnexion
                    </a>
                </li>

            </ul>

        </nav>

    </header>

</body>

</html>