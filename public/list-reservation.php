<?php

$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php";
?>
<div class="container">
    <div class="test">
        <h3>liste des demandes de réservation</h3>
        <?php
        $page = basename(__FILE__);
        require_once('../utile/html/table.php'); ?>
    </div>
</div>

<?php
//SELECT utilisateur.nom AS usernom, utilisateur.prenom AS userprenom, reservation.dateD, reservation.dateF, reservation.statut, materiel.type, materiel.nom AS materielnom FROM `reservation`, `souhait_client`, `materiel`, `utilisateur` WHERE reservation.id_utilisateur = utilisateur.id AND souhait_client.id_materiel = materiel.id AND souhait_client.id_reservation = reservation.id;
include "../utile/html/footer.php";
