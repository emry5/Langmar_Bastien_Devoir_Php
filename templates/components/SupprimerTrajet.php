<?php
if (!isset($idTrajet)) {
    return;
}
?>
<?php /* Formulaire de suppréssion de route lié aux boutons "supprimer" 
de la paje trajet du tableau de bord de l'administrateur 
("dashboard.php -> trajets.php") */ ?>
<form
    method="POST"
    action="index.php?page=SupprimerTrajet"
    class="form-suppression">

    <input
        type="hidden"
        name="id"
        value="<?= (int) $idTrajet ?>">

    <button
        type="submit"
        class="bouton-supprimer bouton-icone"
        title="Supprimer"
        aria-label="Supprimer">
        <i class="bi bi-trash" aria-hidden="true"></i>
    </button>

</form>