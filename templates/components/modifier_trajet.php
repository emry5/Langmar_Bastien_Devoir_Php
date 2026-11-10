<?php
$trajet = $trajet ?? [];
$agences = $agences ?? [];
$erreur = $erreur ?? '';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($trajet) || empty($trajet['trajet_id'])) {
    http_response_code(404);
    exit('Trajet introuvable.');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un trajet</title>

    <link rel="stylesheet" href="/Devoir-php/public/assets/css/style.css">
</head>

<body>

    <?php require __DIR__ . '/header_logged-in.php'; ?>

    <main class="login-main">
        <section class="login-container">
            <h1>Modifier mon trajet</h1>

            <?php if (!empty($erreur)): ?>
                <p class="message-erreur">
                    <?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>

            <form
                method="POST"
                action="index.php?page=modifier_trajet&id=<?= (int) $trajet['trajet_id'] ?>" class="login-form">

                <div class="field-form">
                    <label for="depart_id">Ville de départ</label>

                    <select name="depart_id" id="depart_id" required>

                        <?php foreach ($agences as $agence): ?>
                            <option
                                value="<?= (int) $agence['id_agence'] ?>"
                                <?= (int) $agence['id_agence'] === (int) $trajet['depart_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($agence['villes'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="field-form">
                    <label for="arrivee_id">Ville d'arrivée</label>

                    <select name="arrivee_id" id="arrivee_id" required>

                        <?php foreach ($agences as $agence): ?>
                            <option
                                value="<?= (int) $agence['id_agence'] ?>"
                                <?= (int) $agence['id_agence'] === (int) $trajet['arrivee_id'] ? 'selected' : '' ?>>
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
                        value="<?= htmlspecialchars($trajet['date_depart'], ENT_QUOTES, 'UTF-8') ?>"
                        required>
                </div>

                <div class="field-form">
                    <label for="heure_depart">Heure de départ</label>
                    <input
                        type="time"
                        name="heure_depart"
                        id="heure_depart"
                        value="<?= htmlspecialchars(substr($trajet['heure_depart'], 0, 5), ENT_QUOTES, 'UTF-8') ?>"
                        required>
                </div>

                <div class="field-form">
                    <label for="date_arrivee">Date d'arrivée</label>
                    <input
                        type="date"
                        name="date_arrivee"
                        id="date_arrivee"
                        value="<?= htmlspecialchars($trajet['date_arrivee'], ENT_QUOTES, 'UTF-8') ?>"
                        required>
                </div>

                <div class="field-form">
                    <label for="heure_arrivee">Heure d'arrivée</label>
                    <input
                        type="time"
                        name="heure_arrivee"
                        id="heure_arrivee"
                        value="<?= htmlspecialchars(substr($trajet['heure_arrivee'], 0, 5), ENT_QUOTES, 'UTF-8') ?>"
                        required>
                </div>

                <div class="field-form">
                    <label for="places_totales">Nombre total de places</label>
                    <input
                        type="number"
                        name="places_totales"
                        id="places_totales"
                        min="1"
                        value="<?= (int) $trajet['places_totales'] ?>"
                        required>
                </div>

                <div class="field-form">
                    <label for="places_disponibles">Nombre de places disponibles</label>
                    <input
                        type="number"
                        name="places_disponibles"
                        id="places_disponibles"
                        min="0"
                        max="<?= (int) $trajet['places_totales'] ?>"
                        value="<?= (int) $trajet['places_disponibles'] ?>"
                        required>
                </div>

                <button type="submit">Enregistrer les modifications</button>

                <a href="index.php?page=user" class="stop">Annuler</a>

            </form>

        </section>



    </main>

    <?php require __DIR__ . '/footer.php'; ?>

</body>

</html>