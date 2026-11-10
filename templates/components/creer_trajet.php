<?php

$agences = $agences ?? [];
$erreur = $erreur ?? '';
$donnees = $donnees ?? [];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=formulaire');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Créer un trajet</title>

    <link rel="stylesheet" href="/Devoir-php/public/assets/css/style.css">
</head>

<body>

    <?php require __DIR__ . '/header_logged-in.php'; ?>

    <main class="login-main">

        <section class="login-container">

            <h1>Créer un trajet</h1>

            <?php if (!empty($erreur)): ?>
                <p class="message-erreur">
                    <?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>

            <form
                method="POST"
                action="index.php?page=creer_trajet"
                class="login-form">

                <div class="field-form">
                    <label for="depart_id">Ville de départ</label>

                    <select name="depart_id" id="depart_id" required>

                        <option value="">Choisir une ville</option>

                        <?php foreach ($agences as $agence): ?>
                            <option
                                value="<?= (int) $agence['id_agence'] ?>"
                                <?= (string) ($donnees['depart_id'] ?? '') === (string) $agence['id_agence'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($agence['villes'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="field-form">
                    <label for="arrivee_id">Ville d'arrivée</label>

                    <select name="arrivee_id" id="arrivee_id" required>

                        <option value="">Choisir une ville</option>

                        <?php foreach ($agences as $agence): ?>
                            <option
                                value="<?= (int) $agence['id_agence'] ?>"
                                <?= (string) ($donnees['arrivee_id'] ?? '') === (string) $agence['id_agence'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($agence['villes'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="field-form">
                    <label for="date_depart">Date de départ</label>

                    <input
                        type="date"
                        name="date_depart"
                        id="date_depart"
                        value="<?= htmlspecialchars($donnees['date_depart'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required>
                </div>

                <div class="field-form">
                    <label for="heure_depart">Heure de départ</label>

                    <input
                        type="time"
                        name="heure_depart"
                        id="heure_depart"
                        value="<?= htmlspecialchars($donnees['heure_depart'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required>
                </div>

                <div class="field-form">
                    <label for="date_arrivee">Date d'arrivée</label>

                    <input
                        type="date"
                        name="date_arrivee"
                        id="date_arrivee"
                        value="<?= htmlspecialchars($donnees['date_arrivee'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required>
                </div>

                <div class="field-form">
                    <label for="heure_arrivee">Heure d'arrivée</label>

                    <input
                        type="time"
                        name="heure_arrivee"
                        id="heure_arrivee"
                        value="<?= htmlspecialchars($donnees['heure_arrivee'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required>
                </div>

                <div class="field-form">
                    <label for="places_totales">Nombre total de places</label>

                    <input
                        type="number"
                        name="places_totales"
                        id="places_totales"
                        min="1"
                        value="<?= htmlspecialchars($donnees['places_totales'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required>
                </div>

                <div class="field-form">
                    <label for="places_disponibles">Nombre de places disponibles</label>

                    <input
                        type="number"
                        name="places_disponibles"
                        id="places_disponibles"
                        min="0"
                        value="<?= htmlspecialchars($donnees['places_disponibles'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required>
                </div>

                <button type="submit">Créer un trajet</button>

                <a href="index.php?page=user" class="stop">Annuler</a>

            </form>

        </section>

    </main>

    <?php require __DIR__ . '/footer.php'; ?>

</body>

</html>