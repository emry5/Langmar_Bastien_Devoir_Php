<?php
$trajets = $trajets ?? [];
?>

<div class="table-container">

    <?php if (empty($trajets)): ?>

        <p>Aucun trajet disponible.</p>

    <?php else: ?>

        <table class="table">

            <thead class="table-head">
                <tr class="table-row">
                    <th class="thead-item">Départ</th>
                    <th class="thead-item">Date</th>
                    <th class="thead-item">Heure</th>
                    <th class="thead-item">Destination</th>
                    <th class="thead-item">Date</th>
                    <th class="thead-item">Heure</th>
                    <th class="thead-item">Places</th>
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

                        <td class="tbody-item">
                            <?= htmlspecialchars($trajet['date_depart'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item">
                            <?= htmlspecialchars(substr($trajet['heure_depart'], 0, 5), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item">
                            <?= htmlspecialchars($trajet['arrivee'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item">
                            <?= htmlspecialchars($trajet['date_arrivee'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item">
                            <?= htmlspecialchars(substr($trajet['heure_arrivee'], 0, 5), ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item">
                            <?= htmlspecialchars((string) $trajet['places_disponibles'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>