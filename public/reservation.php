<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php";

?>
<!--  faire un truck bot ADE ou on click-->
<div class="container">
    <div class="tt">
    <form action="<?= basename(__FILE__) . "?id_materiel=" . $_GET['id_materiel']; ?>" method="post">
    <div>
        <label for="date">Choisier votre date de reservation</label>
        </div>
        <div>
        <input type="date" name="date" class="date input">
        <div class="erdate"></div><br>
        </div>
        <div>
        <label for="heur">Horraire debut</label>
</div>
        <div>
        <input type="time" min="8:00" max="16:00" name="horraired" class="heur input">
        <div class="erhorraired"></div><br>
        </div>
        <div>
        <label for="heur">Horraire fin</label>
</div>
        <div>
        <input type="time" min="10:00" max="18:00" name="horrairef" class="heur input">
        <div class="erhorrairef"></div><br>
        </div>
        <div>
        <button type="submit" name="reserver" value="1" class="submit">click sa</button>
        </div>
    </form>

    <a href="list-reservation.php" class="a">Voir la liste de reservation</a>
    </div>
</div>
<?php
if (!empty($_POST['reserver']) && $_POST['reserver'] == "1") {
    $heure_debut_nouvelle = isValid('horraired');
    $heure_fin_nouvelle = isValid('horrairef');
    $date = isValid('date');
    $materiel = corect($_GET['id_materiel']);
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
    }
}
include $path . "html/footer.php";
?>