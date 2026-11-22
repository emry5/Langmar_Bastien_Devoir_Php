<?php
$trajets = $trajets ?? [];
?>

<div class="table-container table-responsive">

    <?php if (empty($trajets)): ?>

        <p class="alert alert-info mb-0">Aucun trajet disponible.</p>

    <?php else: ?>

        <head>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        </head>
        <table class="table table-striped align-middle mb-0">

            <thead class="table-head table-light">
                <tr class="table-row">
                    <th class="thead-item text-nowrap" scope="col">ID</th>
                    <th class="thead-item text-nowrap" scope="col">Conducteur</th>
                    <th class="thead-item text-nowrap" scope="col">Départ</th>
                    <th class="thead-item text-nowrap" scope="col">Date de départ</th>
                    <th class="thead-item text-nowrap" scope="col">Heure de départ</th>
                    <th class="thead-item text-nowrap" scope="col">Destination</th>
                    <th class="thead-item text-nowrap" scope="col">Date d'arrivée</th>
                    <th class="thead-item text-nowrap" scope="col">Heure d'arrivée</th>
                    <th class="thead-item text-nowrap" scope="col">Places totales</th>
                    <th class="thead-item text-nowrap" scope="col">Places disponibles</th>
                    <th class="thead-item text-nowrap" scope="col">Options</th>
                </tr>
            </thead>

            <tbody class="tbody">

                <?php foreach ($trajets as $trajet): ?>

                    <tr class="trajet-row">

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars((string) $trajet['trajet_id'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars($trajet['prenom'] . ' ' . $trajet['nom'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars($trajet['depart'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars($trajet['date_depart'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars(substr($trajet['heure_depart'], 0, 5), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars($trajet['arrivee'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars($trajet['date_arrivee'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars(substr($trajet['heure_arrivee'], 0, 5), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars((string) $trajet['places_totales'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars((string) $trajet['places_disponibles'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item">

                            <form
                                action="index.php?page=admin_supprimer_trajet"
                                method="POST">

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $trajet['trajet_id'] ?>">

                                <button
                                    type="submit"
                                    class="bouton-supprimer bouton-icone"
                                    title="Supprimer"
                                    aria-label="Supprimer">
                                    <i class="bi bi-trash" aria-hidden="true"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>