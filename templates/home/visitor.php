<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Devoir-php/public/assets/css/style.css">
    <title>Accueil projet1</title>
</head>

<body>

    <?php require __DIR__ . '/../components/header_visitor.php'; ?>

    <main class="home">
        <p class="message-accueil">Pour obtenir plus d'informations sur un trajet, veuillez vous connecter</p>

        <?php require __DIR__ . '/../components/board.php'; ?>

    </main>

    <?php require __DIR__ . '/../components/footer.php'; ?>

</body>

</html>