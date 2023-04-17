<?php
$path =   "../utile/";
include $path . "html/header.php";
include $path . "link/linkPdo.php";
include $path . "function.php";
session_start();
$_SESSION['panier'] = ['1', '2', '3'];

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


    
    $dated = corect($_POST['dated']) . ' ' . $_POST['horraire'];
    $datef = corect($_POST['datef']) . ' ' . $_POST['horraire2'];;
    $user = $_COOKIE['id'];

    if () {
        
    }
    execute("INSERT INTO `reservation`(`dateD`, `dateF`, `id_utilisateur`) VALUES (:deted,:datef,:user)", [
        'deted' => $dated,
        'datef' => $datef,
        'user' => $user
    ]);
    $result = execute("SELECT max(id) as id FROM reservation;");
    while ($resa = $result->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($resa as $resa) {
            foreach ($_SESSION['panier'] as $row) {
                # code...
            
            execute("INSERT INTO `souhait_client`(`id_reservation`, `id_materiel`) VALUES (:id_reservation,:id_materiel);", [
                'id_reservation' => $resa['id'],
                'id_materiel' => $row
            ]);
            
            echo"c bon";
        }
        }
    }
    //execute();
}

/**
 * faire une table de jointure avec id de l'utilisateur et id les truck  ligne par ligne 
 */
?>