<?php
if (!empty($_COOKIE)) {
    $path =   "../utile/";
    include $path . "html/header.php";
    include $path . "function.php";
    include $path . "link/link.php";
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
            <?php $result = execute(" SELECT utilisateur.nom as usernom, utilisateur.prenom as userprenom,demande.dateD,demande.dateF,demande.statut,materiel.type,materiel.nom as materielnom FROM `materiel`,`utilisateur`,`demande` WHERE demande.materielId = materiel.id AND utilisateur.id = demande.id_utilisateur;");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    //SELECT utilisateur.nom as usernom, utilisateur.prenom as userprenom,demande.dateD,demande.dateF,demande.statut,materiel.type,materiel.nom as materielnom FROM `materiel`,`utilisateur`,`demande` WHERE demande.materielId = materiel.id AND utilisateur.id = demande.id_utilisateur;
                    if ($row['statut'] != "En attente") {
                        $statut =  $row['statut'] ;
                    }else {
                        $statut = "EN ATTENTE";
                        if ($_COOKIE['Role'] == 'admin') {
                            $statut .= "<td><input type='submit' value='Accepter'> <input type='submit' value='refuser'></td>";
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

            ?>
        </table>
    </div>
<?php
    include "../utile/html/footer.php";
} else {
    header("Location: login.php");
}
