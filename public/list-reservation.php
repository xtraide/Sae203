<?php

$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php";
?>
<div>
    <h3>liste des demandes de réservation</h3>
    <?php require_once('../utile/html/table.php'); ?>
</div>

<?php
//SELECT utilisateur.nom AS usernom, utilisateur.prenom AS userprenom, reservation.dateD, reservation.dateF, reservation.statut, materiel.type, materiel.nom AS materielnom FROM `reservation`, `souhait_client`, `materiel`, `utilisateur` WHERE reservation.id_utilisateur = utilisateur.id AND souhait_client.id_materiel = materiel.id AND souhait_client.id_reservation = reservation.id;
include "../utile/html/footer.php";
