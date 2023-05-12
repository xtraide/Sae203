<?php


$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php";

?>
<div>
    <h3>liste des demandes de réservation</h3>
    <table style="border:solid;">
        <tr>
            <a href=""></a>
            <th style="border:solid;">Nom . prenom</th>
            <td style="border:solid;">Date </td>
            <td style="border:solid;">heur debut heur fin </td>
            <td style="border:solid;">Type . nom du materiel</td>
            <td style="border:solid;">Statut de la demande</td>
        </tr>
        <?php
        if (!empty($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            $result = execute(" SELECT utilisateur.nom AS usernom, utilisateur.prenom AS userprenom,  reservation.id as resid ,reservation.horraire_debut,reservation.horraire_fin, reservation.date, reservation.statut, materiel.type, materiel.nom AS materielnom FROM `reservation`, `materiel`, `utilisateur` WHERE reservation.id_utilisateur = utilisateur.id AND reservation.id_materiel = materiel.id;");
        }

        $result = execute("SELECT utilisateur.nom AS usernom, utilisateur.prenom AS userprenom, reservation.id as resid ,reservation.horraire_debut,reservation.horraire_fin, reservation.date, reservation.statut, materiel.type, materiel.nom AS materielnom FROM `reservation`,  `materiel`, `utilisateur` WHERE reservation.id_utilisateur = utilisateur.id AND reservation.id_materiel = materiel.id; AND utilisateur.id = :user ;", [
            'user' => $_COOKIE['id']
        ]);

        if ($result->rowCount() > 0) {
            while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
                foreach ($row as $row) {

                    //SELECT utilisateur.nom as usernom, utilisateur.prenom as userprenom,demande.dateD,demande.dateF,demande.statut,materiel.type,materiel.nom as materielnom FROM `materiel`,`utilisateur`,`demande` WHERE demande.materielId = materiel.id AND utilisateur.id = demande.id_utilisateur;
                    if ($row['statut'] != "en attente") {

                        $statut =  $row['statut'];
                    } else {
                        $statut = "EN ATTENTE";
                        if ($_SESSION['role'] == 'admin') {
                            $statut .= "
                                <form action=" . basename(__FILE__) . " method='post'>
                                    <td>
                                        <button type='submit' onclick='" . statut("accepter") . "' name='accepter'value='{$row["resid"]}'>Accepter</button>
                                        <button type='submit' onclick='" . statut("refuser") . "'name='refuser' value='{$row["resid"]}'>Refuser</button>
                                    </td>
                                </form>";
                        }
                    }
                    echo "
                        <tr>
                            <td>" . $row['usernom'] . " . " . $row['userprenom'] . "</td>
                            <td>" . $row['date'] . "</td>
                            <td>" . $row['horraire_debut'] . " . " . $row['horraire_fin'] . "</td>
                            <td>" . $row['type'] . " . " . $row['materielnom'] . "</td>
                            <td>" . $statut . "<td>
                            <a href='detail-reservation.php?id={$row["resid"]}'>eeee</a>
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
