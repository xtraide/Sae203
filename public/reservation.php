<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php";


?>
<!--  faire un truck bot ADE ou on click-->
<form action="<?= basename(__FILE__); ?>" method="post">
    <label for="date">Choisier votre date de reservation</label>
    <input type="date" name="date"><br>
    <div class="erdate"></div>
    <label for="heur">Horraire debut</label>
    <input type="time" min="8:00" max="16:00" name="horraired"><br>
    <div class="erhorraired"></div>
    <label for="heur">Horraire debut</label>
    <input type="time" min="10:00" max="18:00" name="horrairef"><br>
    <div class="erhorrairef"></div>
    <button type="submit" name="reserver" value="1">click sa</button>
</form>
<a href="list-reservation.php">Voir la liste de reservation</a>
<?php
if (!empty($_POST['reserver']) && $_POST['reserver'] == "1") {

    $heure_debut_nouvelle = isValid('horraired');
    $heure_fin_nouvelle = isValid('horrairef');
    $date = isValid('date');
    $materiel = corect($_POST['id_materiel']);
    if (!empty($date) && !empty($heure_debut_nouvelle) && !empty($heure_fin_nouvelle)) {

        if (!isConflitHorraire($heure_debut_nouvelle, $heure_fin_nouvelle, $date, $materiel)) {

            $user = corect($_COOKIE['id']);;
            execute("INSERT INTO `reservation`( `date`, `horraire_debut`, `horraire_fin`, `id_utilisateur`, `id_materiel`) VALUES (:date,:horraired,:horrairef,:id_user,:id_materiel);", [
                'date' => $date,
                'horraired' => $heure_debut_nouvelle,
                'horrairef' => $heure_fin_nouvelle,
                'id_user' => $user,
                'id_materiel' =>  $materiel
            ]);

            echo "La commande a bien ete enregistrer ";
        } else {

            echo 'Il y a un conflit avec une réservation existante';
        }
        // requete pour les heure des matos sur le jour SELECT horraire_debut,horraire_fin FROM `panier`,`reservation`,`materiel` WHERE panier.id_reservation = reservation.id and panier.id_materiel = materiel.id and date =date and materiel.id = "4";

        /*execute("INSERT INTO `reservation`(`horraire_debut`, `horraire_fin`, `date`) VALUES (:horraired,:horrairef,:date)", [
            'horraired' => $horraired,
            'horrairef' => $horrairef,
            'date' => $date
        ]);

        foreach ($_SESSION['panier'] as $idmat) {
            execute("INSERT INTO `panier`(`id_reservation`, `id_utilisateur`, `id_materiel`) VALUES ((SELECT MAX(id) FROM `reservation`),:id_utilisateur,:id_materiel)", [
                "id_utilisateur" => $user,
                "id_materiel" => $idmat
            ]);
        }*/
    }
}
include $path . "html/footer.php";
?>