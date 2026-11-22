<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Accueil utilisateur</title>

    <link rel="stylesheet" href="/Devoir-php/public/assets/css/style.css">
</head>

<body>
    <!-- Page utilisateur connecté -->
    <?php /* Header utilisateur connecté */
    require __DIR__ . '/../components/HeaderUser.php';
    ?>

    <main>

        <h1>Bienvenue sur votre espace personnel</h1>

        <?php /* Tableau des trajets vue utilisateur connecté */
        require __DIR__ . '/../components/UserBoard.php';
        ?>


    </main>
    <?php /* Footer */
    require __DIR__ . '/../components/Footer.php';
    ?>

</body>

</html>