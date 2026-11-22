<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Devoir-php/public/assets/css/style.css">
    <title>Formulaire de connexion</title>
</head>

<?php /* Page de connexion compte utilisateur ou administrateur */ ?>

<body>

    <?php /* header */
    require __DIR__ . '/../components/HeaderVisitor.php';
    ?>

    <main class="login-main container py-5">

        <section class="login-container card shadow-sm mx-auto p-4">

            <h1 class="text-center mb-4">Connexion</h1>

            <?php if (!empty($erreur)): ?>
                <p class="error-message alert alert-danger" role="alert">
                    <?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>

            <form action="index.php?page=connexion" method="post" class="login-form">

                <div class="field-form mb-3">

                    <label for="email" class="form-label">
                        Adresse e-mail
                    </label>

                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="Exemple : nom@email.fr"
                        autocomplete="email"
                        required>

                </div>

                <div class="field-form mb-3">

                    <label for="password" class="form-label">
                        Mot de passe
                    </label>

                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Saisissez votre mot de passe"
                        autocomplete="current-password"
                        required>

                </div>

                <button type="submit" name="connexion" class="btn btn-primary w-100">
                    Se connecter
                </button>

            </form>

            <div class="text-center mt-3">

                <p class="password-lost mb-1">
                    Mot de passe perdu ?
                </p>

                <a href="#">
                    Réinitialiser votre mot de passe
                </a>

            </div>

        </section>

    </main>

    <?php /* Footer */
    require __DIR__ . '/../components/Footer.php';
    ?>

</body>

</html>