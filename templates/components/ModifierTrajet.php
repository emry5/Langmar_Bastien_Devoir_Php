<?php
$trajet = $trajet ?? [];
$agences = $agences ?? [];
$erreur = $erreur ?? '';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
/* Page de formulaire de modification de trajet */
/*Afficher un message d'erreur si aucun trajet n'est trouvé */

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

    <?php /* Header utilisateur connecté */
    require __DIR__ . '/HeaderUser.php';
    ?>

    <main class="trajet-main container py-5">

        <section class="trajet-container card shadow-sm mx-auto p-4">

            <h1 class="text-center mb-4">Modifier mon trajet</h1>

            <?php if (!empty($erreur)): ?>
                <p class="message-erreur alert alert-danger" role="alert">
                    <?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>

            <form
                method="POST"
                action="index.php?page=modifier_trajet&id=<?= (int) $trajet['trajet_id'] ?>"
                class="trajet-form">

                <div class="row g-3">

                    <div class="col-md-6 field-form">

                        <label for="depart_id" class="form-label">
                            Ville de départ
                        </label>

                        <select
                            name="depart_id"
                            id="depart_id"
                            class="form-select"
                            required>

                            <?php foreach ($agences as $agence): ?>
                                <option
                                    value="<?= (int) $agence['id_agence'] ?>"
                                    <?= (int) $agence['id_agence'] === (int) $trajet['depart_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($agence['villes'], ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-6 field-form">

                        <label for="arrivee_id" class="form-label">
                            Ville d'arrivée
                        </label>

                        <select
                            name="arrivee_id"
                            id="arrivee_id"
                            class="form-select"
                            required>

                            <?php foreach ($agences as $agence): ?>
                                <option
                                    value="<?= (int) $agence['id_agence'] ?>"
                                    <?= (int) $agence['id_agence'] === (int) $trajet['arrivee_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($agence['villes'], ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-6 field-form">

                        <label for="date_depart" class="form-label">
                            Date de départ
                        </label>

                        <input
                            type="date"
                            name="date_depart"
                            id="date_depart"
                            class="form-control"
                            value="<?= htmlspecialchars($trajet['date_depart'], ENT_QUOTES, 'UTF-8') ?>"
                            required>

                    </div>

                    <div class="col-md-6 field-form">

                        <label for="heure_depart" class="form-label">
                            Heure de départ
                        </label>

                        <input
                            type="time"
                            name="heure_depart"
                            id="heure_depart"
                            class="form-control"
                            value="<?= htmlspecialchars(substr($trajet['heure_depart'], 0, 5), ENT_QUOTES, 'UTF-8') ?>"
                            required>

                    </div>

                    <div class="col-md-6 field-form">

                        <label for="date_arrivee" class="form-label">
                            Date d'arrivée
                        </label>

                        <input
                            type="date"
                            name="date_arrivee"
                            id="date_arrivee"
                            class="form-control"
                            value="<?= htmlspecialchars($trajet['date_arrivee'], ENT_QUOTES, 'UTF-8') ?>"
                            required>

                    </div>

                    <div class="col-md-6 field-form">

                        <label for="heure_arrivee" class="form-label">
                            Heure d'arrivée
                        </label>

                        <input
                            type="time"
                            name="heure_arrivee"
                            id="heure_arrivee"
                            class="form-control"
                            value="<?= htmlspecialchars(substr($trajet['heure_arrivee'], 0, 5), ENT_QUOTES, 'UTF-8') ?>"
                            required>

                    </div>

                    <div class="col-md-6 field-form">

                        <label for="places_totales" class="form-label">
                            Nombre total de places
                        </label>

                        <input
                            type="number"
                            name="places_totales"
                            id="places_totales"
                            class="form-control"
                            min="1"
                            value="<?= (int) $trajet['places_totales'] ?>"
                            required>

                    </div>

                    <div class="col-md-6 field-form">

                        <label for="places_disponibles" class="form-label">
                            Nombre de places disponibles
                        </label>

                        <input
                            type="number"
                            name="places_disponibles"
                            id="places_disponibles"
                            class="form-control"
                            min="0"
                            max="<?= (int) $trajet['places_totales'] ?>"
                            value="<?= (int) $trajet['places_disponibles'] ?>"
                            required>

                    </div>

                </div>

                <div class="d-flex flex-column flex-sm-row gap-3 mt-4">

                    <button type="submit" class="btn btn-primary flex-fill">
                        Enregistrer les modifications
                    </button>

                    <a
                        href="index.php?page=user"
                        class="btn btn-primary flex-fill text-center">
                        Annuler
                    </a>

                </div>

            </form>

        </section>

    </main>

    <?php /* footer */
    require __DIR__ . '/Footer.php';
    ?>

</body>

</html>