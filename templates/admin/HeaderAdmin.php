<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="site-header">

    <nav class="navbar navbar-expand-lg container">

        <span class="site-title">
            <a href="index.php?page=admin">Touche pas au klaxon</a>
        </span>

        <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3">

            <li class="nav-item">
                <a class="btn btn-create" href="index.php?page=admin&section=utilisateurs">
                    Utilisateurs
                </a>
            </li>

            <li class="nav-item">
                <a class="btn btn-create" href="index.php?page=admin&section=agences">
                    Agences
                </a>
            </li>

            <li class="nav-item">
                <a class="btn btn-create" href="index.php?page=admin&section=trajets">
                    Trajets
                </a>
            </li>

            <li class="nav-item">
                <span class="nav-link">
                    Bonjour,
                    <?= htmlspecialchars($_SESSION['admin_prenom'] ?? 'Administrateur', ENT_QUOTES, 'UTF-8') ?>
                    <?= htmlspecialchars($_SESSION['admin_nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                </span>
            </li>

            <li class="nav-item">
                <a class="btn btn-create" href="index.php?page=admin_deconnexion">
                    Déconnexion
                </a>
            </li>

        </ul>

    </nav>

</header>