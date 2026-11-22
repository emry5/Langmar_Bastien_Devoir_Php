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
    <?php
    $section = $section ?? 'utilisateurs';

    require __DIR__ . '/../admin/HeaderAdmin.php';
    ?>

    <main>
        <h1>Tableau de bord de l'administrateur:</h1>

        <div>

            <?php if (!empty($erreur)): ?>
                <p class="error-message">
                    <?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($message)): ?>
                <p class="success-message">
                    <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>

            <?php
            switch ($section) {

                case 'utilisateurs':
                    require __DIR__ . '/user.php';
                    break;

                case 'agences':
                    require __DIR__ . '/agences.php';
                    break;

                case 'trajets':
                    require __DIR__ . '/trajets.php';
                    break;

                default:
                    require __DIR__ . '/user.php';
                    break;
            }
            ?>

        </div>
    </main>

    <?php require __DIR__ . '/../components/footer.php'; ?>

</body>

</html>