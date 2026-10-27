<?php

require_once __DIR__ . '../../../Core/autoloader.php';
Autoloader::register();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Devoir-php/public/assets/css/style.css">

</head>

<body>

    <header class="site-header">
        <nav class="navbar navbar-expand-lg container">
            <span class="site-title">
                <p>Touche pas au klaxon</p>
            </span>
            <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3">
                <!--boutons creer un trajet et deconnexion dans un rectangle noir ou de couleur couleur du texte: blanc -->
                <li class="nav-item">
                    <a class="btn btn-create" href="#">Créer un trajet</a>
                </li>
                <!--avant nom et prénom penser à ajouter fonction php "Bonjour + Prénom Nom (police plus petite que les boutons) -->
                <?php

                $id = new Identity();
                $id->name = "John Doe";
                ?>
                <li class="nav-item user-greeting">
                    Bonjour <?php $id->displayName(); ?>
                </li>
                <li class="nav-item">
                    <a class="btn btn-create" href="#">Deconnexion</a>
                </li>
            </ul>
        </nav>
    </header>
</body>

</html>