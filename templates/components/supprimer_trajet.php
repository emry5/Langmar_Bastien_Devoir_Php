<?php
if (!isset($idTrajet)) {
    return;
}
?>

<form
    method="POST"
    action="index.php?page=supprimer_trajet"
    class="form-suppression">

    <input
        type="hidden"
        name="id"
        value="<?= (int) $idTrajet ?>">

    <button type="submit">
        Suppr
    </button>

</form>