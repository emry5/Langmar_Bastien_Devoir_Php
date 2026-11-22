<?php
$utilisateurs = $utilisateurs ?? [];
?>

<div class="table-container table-responsive">

    <?php if (empty($utilisateurs)): ?>

        <p class="alert alert-info mb-0">Aucun utilisateur disponible.</p>

    <?php else: ?>

        <table class="table table-striped align-middle mb-0">

            <thead class="table-head table-light">
                <tr class="table-row">
                    <th class="thead-item text-nowrap" scope="col">ID</th>
                    <th class="thead-item text-nowrap" scope="col">Nom</th>
                    <th class="thead-item text-nowrap" scope="col">Prénom</th>
                    <th class="thead-item text-nowrap" scope="col">Téléphone</th>
                    <th class="thead-item text-nowrap" scope="col">Adresse e-mail</th>
                </tr>
            </thead>

            <tbody class="tbody">

                <?php foreach ($utilisateurs as $utilisateur): ?>

                    <tr class="trajet-row">

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars((string) $utilisateur['id'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars($utilisateur['nom'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars($utilisateur['prenom'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars($utilisateur['telephone'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item text-nowrap">
                            <?= htmlspecialchars($utilisateur['email'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>