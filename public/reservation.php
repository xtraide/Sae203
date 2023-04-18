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
    $dated = "2023-04-17";
    $horraired ='18:00:00';
    $horrairef = '20:00:00';
    $user = $_COOKIE['id'];
    foreach ($_SESSION['panier'] as $idmat) {
        execute("INSERT INTO `panier`(`id_materiel`) VALUES (:id_materiel)", [
            "id_materiel" => $idmat
        ]);
    }
    
    execute("INSERT INTO `reservation`(`date`, `dateF`, `id_utilisateur`) VALUES (:deted,:datef,:user)", [
        'deted' => $dated,
        'datef' => $datef,
        'user' => $user
    ]);

    foreach ($_SESSION['panier'] as $row) {
        execute("INSERT INTO `souhait_client`(`id_reservation`, `id_materiel`) VALUES ((SELECT max(id)  FROM reservation),:id_materiel);", [
            'id_materiel' => $row
        ]);
        
    }
    echo "La commande a bien ete enregistrer ";
}
/**
 * faire une table de jointure avec id de l'utilisateur et id les truck  ligne par ligne 
 */
?>