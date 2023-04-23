<?php
if (!empty($_COOKIE)) {
    $path =   "../utile/";
    include $path . "html/header.php";
    include $path . "function.php";
    include $path . "link/linkPdo.php";
?>

    <div>
        <h3>liste des demandes de réservation</h3>
        <table style="border:solid;">
            <tr>
                <th style="border:solid;">Nom . prenom</th>
                <td style="border:solid;">Date de debut . Date de fin de pret</td>
                <td style="border:solid;">Type . nom du materiel</td>
                <td style="border:solid;">Statut de la demande</td>

            </tr>
            <?php 
            if (!empty($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                $result = execute(" SELECT utilisateur.nom AS usernom, utilisateur.prenom AS userprenom, reservation.dateD, reservation.dateF, reservation.statut, materiel.type, materiel.nom AS materielnom FROM `reservation`, `souhait_client`, `materiel`, `utilisateur` WHERE reservation.id_utilisateur = utilisateur.id AND souhait_client.id_materiel = materiel.id AND souhait_client.id_reservation = reservation.id;");
            }
            session_start();
            $result = execute("SELECT utilisateur.nom AS usernom, utilisateur.prenom AS userprenom, reservation.dateD, reservation.dateF, reservation.statut, materiel.type, materiel.nom AS materielnom FROM `reservation`, `souhait_client`, `materiel`, `utilisateur` WHERE reservation.id_utilisateur = utilisateur.id AND souhait_client.id_materiel = materiel.id AND souhait_client.id_reservation = reservation.id; AND utilisateur.id = :user ;", [
                'user' => $_COOKIE['id']
            ]);
             
            if ($result->rowCount() > 0) {
                while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
                    foreach ($row as $row) {

              
                    //SELECT utilisateur.nom as usernom, utilisateur.prenom as userprenom,demande.dateD,demande.dateF,demande.statut,materiel.type,materiel.nom as materielnom FROM `materiel`,`utilisateur`,`demande` WHERE demande.materielId = materiel.id AND utilisateur.id = demande.id_utilisateur;
                    if ($row['statut'] != "En attente") {
                        $statut =  $row['statut'];
                    } else {
                        $statut = "EN ATTENTE";
                        if ($_SESSION['role'] == 'admin') {
                            $statut .= "<form action=" .basename(__FILE__)." method='post'><td><input type='submit' value='Accepter'> <input type='submit' value='refuser'></td></form>";
                        }
                    }
                    echo "
            <tr>
                <td>" . $row['usernom'] . " . " . $row['userprenom'] . "</td>
                <td>" . $row['dateD'] . " . " . $row['dateF'] . "</td>
                <td>" . $row['type'] . " . " . $row['materielnom'] . "</td>
                <td>" . $statut . "<td>
            </tr>";
                }
            }
        }

            ?>
        </table>
    </div>
<?php
//SELECT utilisateur.nom AS usernom, utilisateur.prenom AS userprenom, reservation.dateD, reservation.dateF, reservation.statut, materiel.type, materiel.nom AS materielnom FROM `reservation`, `souhait_client`, `materiel`, `utilisateur` WHERE reservation.id_utilisateur = utilisateur.id AND souhait_client.id_materiel = materiel.id AND souhait_client.id_reservation = reservation.id;
    include "../utile/html/footer.php";
} else {
    header("Location: login.php");
}
