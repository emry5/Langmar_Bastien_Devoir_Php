<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Devoir-php/public/assets/css/style.css">
    <title>Formulaire de connexion</title>
</head>

<body>
    <?php require __DIR__ . '/../components/header_visitor.php'; ?>

    <main class="login-main">
        <section class="login-container">
            <h1>Connexion</h1>

            <?php if (!empty($erreur)): ?>
                <p class="error-message">
                    <?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>

            <form action="index.php?page=connexion" method="post" class="login-form">
                <div class="field-form">
                    <label for="email">Adresse e-mail</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Exemple : nom@email.fr"
                        autocomplete="email"
                        required>
                </div>
                <div class="field-form">
                    <label for="password">Mot de passe</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Saisissez votre mot de passe"
                        autocomplete="current-password"
                        required>
                </div>
                <button type="submit" name="connexion">
                    Se connecter
                </button>
            </form>
            <p class="password-lost">Mot de passe perdu ?</p>
            <a href="#">Réinitialiser votre mot de passe</a>
        </section>
    </main>
</body>
<?php require __DIR__ . '/../components/footer.php'; ?>

</html>