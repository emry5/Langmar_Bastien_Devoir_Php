<?php
$trajets = $trajets ?? [];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="table-container table-responsive">

    <?php /* Message à afficher si aucun trajet disponible, 
    sinon afficher le tableau des trajets */
    if (empty($trajets)): ?>

        <p class="alert alert-info mb-0">Aucun trajet disponible.</p>

    <?php else: ?>
        <?php /* Tableau des trajets vue utilisateur */ ?>

        <table class="table table-striped table-hover align-middle mb-0">

            <?php /* Cellules d'entêtes */ ?>
            <thead class="table-head table-light">
                <tr class="table-row">
                    <th class="thead-item text-nowrap">Départ</th>
                    <th class="thead-item text-nowrap">Date</th>
                    <th class="thead-item text-nowrap">Heure</th>
                    <th class="thead-item text-nowrap">Destination</th>
                    <th class="thead-item text-nowrap">Date</th>
                    <th class="thead-item text-nowrap">Heure</th>
                    <th class="thead-item text-nowrap">Places</th>
                    <th class="thead-item text-nowrap">Actions</th>
                </tr>
            </thead>

            <tbody class="tbody">
                <?php /* Corps du tableau comportant les infos des trajets contenues dans la base de données */ ?>
                <?php foreach ($trajets as $trajet): ?>

                    <tr class="trajet-row">

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
                            <?= htmlspecialchars((string) $trajet['places_disponibles'], ENT_QUOTES, 'UTF-8') ?>
                        </td>

                        <td class="tbody-item">

                            <?php if (isset($_SESSION['user_id'])): ?>

                                <div class="d-flex flex-wrap align-items-center gap-2">

                                    <button
                                        type="button"
                                        class="bouton-details bouton-icone"
                                        data-trajet-id="<?= (int) $trajet['trajet_id'] ?>"
                                        title="Détails"
                                        aria-label="Détails">
                                        <?php /* Icone bouton d'action */ ?>
                                        <i class="bi bi-eye" aria-hidden="true"></i>
                                    </button>

                                    <?php if (
                                        (int) $trajet['utilisateurs_id'] ===
                                        (int) $_SESSION['user_id']
                                    ): ?>

                                        <a
                                            href="index.php?page=ModifierTrajet&id=<?= (int) $trajet['trajet_id'] ?>"
                                            class="bouton-icone"
                                            title="Modifier"
                                            aria-label="Modifier">
                                            <?php /* Icone bouton d'action */ ?>
                                            <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                        </a>

                                        <?php
                                        /* route composant SupprimerTrajet.php */
                                        $idTrajet = (int) $trajet['trajet_id'];
                                        require __DIR__ . '/SupprimerTrajet.php';
                                        ?>

                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>


<!-- FENÊTRE MODALE -->

<div id="modal-trajet" class="modal-trajet">

    <div class="modal-contenu">
        <?php /* Bouton de fermeture de la fenêtre modale*/ ?>
        <button
            type="button"
            id="fermer-modal"
            class="modal-fermer"
            aria-label="Fermer">
            &times;
        </button>

        <?php /* Infos détaillées du trajet */ ?>
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
    <?php /* Charge la page avec les infos de la fenetre modale*/ ?>

    document.addEventListener('DOMContentLoaded', function() {

        <?php /* Récuperation des boutons "Détails" */ ?>
        const boutonsDetails = document.querySelectorAll('.bouton-details');

        <?php /* Récuperation des Eléments de la fenêtre modale */ ?>

        const modal = document.getElementById('modal-trajet');
        const boutonFermer = document.getElementById('fermer-modal');

        const chargement = document.getElementById('modal-chargement');
        const informations = document.getElementById('modal-informations');
        const erreur = document.getElementById('modal-erreur');

        <?php /* Fonction de fermeture de la fenêtre modale */ ?>

        function fermerModal() {
            modal.style.display = 'none';
        }

        <?php /* Fonction d'affichage de la fenêtre modale */ ?>

        function afficherModal() {
            modal.style.display = 'flex';

            chargement.hidden = false;
            informations.hidden = true;
            erreur.hidden = true;
        }
        <?php /*Parcourir tous les boutons "détails"+ 
                détecter le click sur un bouton +
                récupérer l'identifiant d'un trajet +
                afficher la fenêtre modale */ ?>
        boutonsDetails.forEach(function(bouton) {

            bouton.addEventListener('click', async function() {

                const id = this.dataset.trajetId;

                afficherModal();
                <?php /* Récuperation des informations depuis PHP */ ?>
                try {

                    const reponse = await fetch(
                        'index.php?page=details_trajet&id=' + encodeURIComponent(id)
                    );
                    <?php /* Vérification de la réponse du serveur*/ ?>
                    if (!reponse.ok) {
                        throw new Error('Erreur lors de la récupération du trajet.');
                    }

                    <?php /* Conversion de la réponse en JSON */ ?>

                    const trajet = await reponse.json();

                    <?php /* Infos détaillées du trajet + conducteur */ ?>

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

                    <?php /* Masquage du chargement et affichage des informations */ ?>
                    chargement.hidden = true;
                    informations.hidden = false;

                    <?php /* Gestion des erreurs */ ?>
                } catch (erreurRequete) {

                    console.error(erreurRequete);

                    chargement.hidden = true;
                    erreur.hidden = false;
                }

            });

        });
        <?php /* Fermer la fenêtre modale avec le bouton X */ ?>
        boutonFermer.addEventListener('click', fermerModal);

        <?php /* Fermer la fenêtre modale en cliquant à l'exterieur de celle-ci*/ ?>
        modal.addEventListener('click', function(event) {

            if (event.target === modal) {
                fermerModal();
            }

        });
        <?php /* Fermer la fenêtre modale avec la touche "Echap" */ ?>
        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {
                fermerModal();
            }

        });

    });
</script>