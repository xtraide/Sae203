<?php
$path =   "../utile/";
include $path . "html/header.php";
include $path . "link/linkPdo.php";
include $path . "function.php";
session_start();
$_SESSION['panier'] = ['4', '5', '6'];

?>
<!--  faire un truck bot ADE ou on click-->
<form action="reservation.php" method="post">
    <label for="date">dated</label>
    <input type="date" name="dated"> <br>
    <label for="date"> datef Choisier votre date de reservation</label>
    <input type="date" name="datef"><br>
    <label for="heur">horair debut</label>
    <input type="text" name="horraire"><br>
    <label for="heur">horair debut</label>
    <input type="text" name="horraire2"><br>
    <button type="submit" name="reserver" value="1">click sa</button>
</form>

<?php
if (!empty($_POST['reserver']) && $_POST['reserver'] == "1") {


    //execute("SELECT  FROM  ");
    //$dated = corect($_POST['dated']) . ' ' . $_POST['horraire'];
    //$datef = corect($_POST['datef']) . ' ' . $_POST['horraire2'];;
    $date = "2023-04-17";
    $horraired ='18:00:00';
    $horrairef = '20:00:00';
    $user = $_COOKIE['id'];

    execute("INSERT INTO `reservation`(`horraire_debut`, `horraire_fin`, `date`) VALUES (:horraired,:horrairef,:date)", [
        'horraired' => $horraired,
        'horrairef' => $horrairef,
        'date' => $date
    ]);
    foreach ($_SESSION['panier'] as $idmat) {
        execute("INSERT INTO `panier`(`id_reservation`, `id_utilisateur`, `id_materiel`) VALUES ((SELECT MAX(id) FROM `reservation`),:id_utilisateur,:id_materiel)", [
            "id_utilisateur" => $user,
            "id_materiel" => $idmat
        ]);
    }
    echo "La commande a bien ete enregistrer ";
}
/**
 * faire une table de jointure avec id de l'utilisateur et id les truck  ligne par ligne 
 */
?>