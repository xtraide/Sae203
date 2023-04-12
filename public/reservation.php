<?php
if(!empty($_COOKIE['id'])){
    $path =   "../utile/";
    include $path . "html/header.php";
    include $path . "function.php";
    include $path . "link/link.php";
    ?>
        <table style="border:solid;">
        <tr>
            <th>Nom . prenom</th>
            <td>Date de debut . Date de fin de pret</td>
            <td>Type . nom du materiel</td>
            <td>Statut de la demande</td>
        </tr>
        <?php

    $result = execute("SELECT utilisateur.nom as usernom, utilisateur.prenom as userprenom,demande.dateD,demande.dateF,demande.statut,materiel.type,materiel.nom as materielnom FROM `materiel`,`utilisateur`,`demande` WHERE demande.materielId = materiel.id AND utilisateur.id = demande.id_utilisateur AND utilisateur.id ='".$_COOKIE['id']."';");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if(empty($row['statut'])){
                $statut = "en attente de retoure de l'administrateur ";
            }else{
                $statut = $row['statut'];
            }
            echo "
            <tr>
                <td>".$row['usernom']." . ".$row['userprenom']."</td>
                <td>".$row['dateD']." . ".$row['dateF']."</td>
                <td>".$row['type']." . ".$row['materielnom']."</td>
                <td>". $statut."<td>
            </tr>";
        }
    }
    ?>
        </table>
        <?php
    include "../utile/html/footer.php";
}else{
    header('Location: login.php');
}

