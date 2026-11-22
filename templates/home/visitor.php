<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Devoir-php/public/assets/css/style.css">
    <title>Accueil projet1</title>
</head>

<body>
    <!-- Page visiteur -->
    <?php /* Header visiteur */
    require __DIR__ . '/../components/HeaderVisitor.php';
    ?>

    <main class="home">
        <p class="message-accueil">Pour obtenir plus d'informations sur un trajet, veuillez vous connecter</p>

        <?php /* Tableau des trajets vue visiteur */
        require __DIR__ . '/../components/Board.php';
        ?>

    </main>

    <?php /* Footer */
    require __DIR__ . '/../components/Footer.php';
    ?>

</body>

</html>