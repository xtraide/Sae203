<?php
$path =   "../utile/";
include $path . "html/header.php";
include $path . "link/linkPdo.php";
$_SESSION['demande'] = ['1', '2', '3'];

?>
<!--  faire un truck bot ADE ou on click-->
<form action="reservation.php" method="post">
    <label for="date">Choisier votre date de reservation</label>
    <input type="date" name="date">
    <label for="heur">note ici l'heur de reservation</label>
    <input type="number" name="horraire">
    <button type="submit" name="reserver" value="1">click sa</button>
</form>


<?php
if (!empty($_POST['reserver']) && $_POST['reserver'] == "1") {
    //execute();
}
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    }
}
/**
 * faire une table de jointure avec id de l'utilisateur et id les truck  ligne par ligne 
 */
?>