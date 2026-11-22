<?php
$agences = $agences ?? [];
?>

<main class="admin-agences-main">

    <section class="admin-agences-container">

        <h1>Gestion des agences</h1>

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

        <section class="agence-creation">

            <h2>Créer une agence</h2>

            <form action="index.php?page=creer_agence" method="POST" class="agence-form">

                <div class="agence-field">

                    <label for="villes">Nom de la ville</label>

                    <input
                        type="text"
                        id="villes"
                        name="villes"
                        placeholder="Exemple : Paris"
                        maxlength="150"
                        required>

                </div>

                <button type="submit" class="agence-button">
                    Créer l'agence
                </button>

            </form>

        </section>

        <section class="agence-liste">

            <h2>Liste des agences</h2>

            <?php if (empty($agences)): ?>

                <p>Aucune agence enregistrée.</p>

            <?php else: ?>

                <?php foreach ($agences as $agence): ?>

                    <div class="agence-item">

                        <form action="index.php?page=modifier_agence" method="POST" class="agence-form">

                            <input
                                type="hidden"
                                name="id_agence"
                                value="<?= (int) $agence['id_agence'] ?>">

                            <div class="agence-field">

                                <label for="ville-<?= (int) $agence['id_agence'] ?>">
                                    Ville
                                </label>

                                <input
                                    type="text"
                                    id="ville-<?= (int) $agence['id_agence'] ?>"
                                    name="villes"
                                    value="<?= htmlspecialchars($agence['villes'], ENT_QUOTES, 'UTF-8') ?>"
                                    maxlength="150"
                                    required>

                            </div>

                            <button type="submit" class="agence-button">
                                Modifier
                            </button>

                        </form>

                        <form action="index.php?page=supprimer_agence" method="POST" class="agence-form">

                            <input
                                type="hidden"
                                name="id_agence"
                                value="<?= (int) $agence['id_agence'] ?>">

                            <button type="submit" class="agence-button agence-button-delete">
                                Supprimer
                            </button>

                        </form>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </section>

    </section>

</main>