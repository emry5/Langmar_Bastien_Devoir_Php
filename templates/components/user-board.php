<?php
$trajets = $trajets ?? [];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
                    <th class="thead-item">Options</th>
                </tr>
            </thead>

            <tbody class="tbody">

                <?php foreach ($trajets as $trajet): ?>

                    <tr class="trajet-row">

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

                        <td class="tbody-item">

                            <?php if (isset($_SESSION['user_id'])): ?>

                                <button
                                    type="button"
                                    class="bouton-details"
                                    data-trajet-id="<?= (int) $trajet['trajet_id'] ?>">
                                    Détails
                                </button>

                                <?php if (
                                    (int) $trajet['utilisateurs_id'] ===
                                    (int) $_SESSION['user_id']
                                ): ?>

                                    <a href="index.php?page=modifier_trajet&id=<?= (int) $trajet['trajet_id'] ?>">
                                        Modifier
                                    </a>

                                    <?php
                                    $idTrajet = (int) $trajet['trajet_id'];
                                    require __DIR__ . '/supprimer_trajet.php';
                                    ?>

                                <?php endif; ?>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>


<!-- ================================================= -->
<!-- FENÊTRE MODALE : INFORMATIONS DU TRAJET           -->
<!-- ================================================= -->

<div id="modal-trajet" class="modal-trajet">

    <div class="modal-contenu">

        <button
            type="button"
            id="fermer-modal"
            class="modal-fermer"
            aria-label="Fermer">
            &times;
        </button>

        <h2>Détails du trajet</h2>

        <div id="modal-chargement">
            Chargement des informations...
        </div>

        <div id="modal-informations" hidden>

            <h3>Conducteur</h3>

            <p>
                <strong>Identité :</strong>
                <span id="conducteur-nom"></span>
            </p>

            <p>
                <strong>Téléphone :</strong>
                <span id="conducteur-telephone"></span>
            </p>

            <p>
                <strong>Adresse e-mail :</strong>
                <span id="conducteur-email"></span>
            </p>

            <hr>

            <h3>Places du véhicule</h3>

            <p>
                <strong>Nombre total de places :</strong>
                <span id="places-totales"></span>
            </p>

            <p>
                <strong>Places disponibles :</strong>
                <span id="places-disponibles"></span>
            </p>

        </div>

        <div id="modal-erreur" hidden>
            Impossible de récupérer les informations du trajet.
        </div>

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const boutonsDetails = document.querySelectorAll('.bouton-details');

        const modal = document.getElementById('modal-trajet');
        const boutonFermer = document.getElementById('fermer-modal');

        const chargement = document.getElementById('modal-chargement');
        const informations = document.getElementById('modal-informations');
        const erreur = document.getElementById('modal-erreur');

        function fermerModal() {
            modal.style.display = 'none';
        }

        function afficherModal() {
            modal.style.display = 'flex';

            chargement.hidden = false;
            informations.hidden = true;
            erreur.hidden = true;
        }

        boutonsDetails.forEach(function(bouton) {

            bouton.addEventListener('click', async function() {

                const id = this.dataset.trajetId;

                afficherModal();

                try {

                    const reponse = await fetch(
                        'index.php?page=details_trajet&id=' + encodeURIComponent(id)
                    );

                    if (!reponse.ok) {
                        throw new Error('Erreur lors de la récupération du trajet.');
                    }

                    const trajet = await reponse.json();

                    document.getElementById('conducteur-nom').textContent =
                        trajet.prenom + ' ' + trajet.nom;

                    document.getElementById('conducteur-telephone').textContent =
                        trajet.telephone;

                    document.getElementById('conducteur-email').textContent =
                        trajet.email;

                    document.getElementById('places-totales').textContent =
                        trajet.places_totales;

                    document.getElementById('places-disponibles').textContent =
                        trajet.places_disponibles;

                    chargement.hidden = true;
                    informations.hidden = false;

                } catch (erreurRequete) {

                    console.error(erreurRequete);

                    chargement.hidden = true;
                    erreur.hidden = false;
                }

            });

        });

        boutonFermer.addEventListener('click', fermerModal);

        modal.addEventListener('click', function(event) {

            if (event.target === modal) {
                fermerModal();
            }

        });

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {
                fermerModal();
            }

        });

    });
</script>