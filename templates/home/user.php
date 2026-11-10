<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Accueil utilisateur</title>

    <link rel="stylesheet" href="/Devoir-php/public/assets/css/style.css">
</head>

<body>
    <?php require __DIR__ . '/../components/header_logged-in.php'; ?>

    <main>

        <h1>Bienvenue sur votre espace personnel</h1>

        <?php require __DIR__ . '/../components/user-board.php'; ?>


    </main>
    <?php require __DIR__ . '/../components/footer.php'; ?>

</body>

</html>