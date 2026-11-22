<?php
$trajets = $trajets ?? [];

/* Tableau de bord visible par les visiteurs */
?>

<div class="table-container table-responsive">

    <?php if (empty($trajets)): ?>

        <p class="alert alert-info mb-0">
            Aucun trajet disponible.
        </p>

    <?php else: ?>

        <table class="table table-striped align-middle mb-0">

            <thead class="table-head table-light">
                <tr class="table-row">
                    <th scope="col" class="thead-item text-nowrap">Départ</th>
                    <th scope="col" class="thead-item text-nowrap">Date</th>
                    <th scope="col" class="thead-item text-nowrap">Heure</th>
                    <th scope="col" class="thead-item text-nowrap">Destination</th>
                    <th scope="col" class="thead-item text-nowrap">Date</th>
                    <th scope="col" class="thead-item text-nowrap">Heure</th>
                    <th scope="col" class="thead-item text-nowrap">Places</th>
                </tr>
            </thead>

            <tbody class="tbody">

                <?php foreach ($trajets as $trajet): ?>

                    <tr
                        class="trajet-row"
                        data-trajet-id="<?= (int) $trajet['trajet_id'] ?>">

                        <td class="tbody-item">
                            <?= htmlspecialchars($trajet['depart'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars($trajet['date_depart'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars(substr($trajet['heure_depart'], 0, 5), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item">
                            <?= htmlspecialchars($trajet['arrivee'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars($trajet['date_arrivee'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars(substr($trajet['heure_arrivee'], 0, 5), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars((string) $trajet['places_disponibles'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>