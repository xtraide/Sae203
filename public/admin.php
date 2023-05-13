<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php";


if (array_key_exists('role', $_SESSION) && $_SESSION['role'] ==  'admin') {
    /**
     * Ajouter un materiel 
     */
?>
    <div>
        <label for="ajout">
            <h2>Ajouter un materiel</h2>
        </label>
        <form action="<?= basename(__FILE__); ?>" method="post" enctype="multipart/form-data">
            <label for="Nom">Nom : </label>
            <input type="text" placeholder="Nom" name="nom" value="<?= !empty($_POST['nom']) ?  $_POST['nom'] : '' ?>">
            <div class="ernom"></div>
            <label for="type">Type : • Type (Liste déroulante)</label>
            <input type="text" placeholder="Type de materiel" name="type" value="<?= !empty($_POST['type']) ?  $_POST['type'] : '' ?>">
            <div class="ertype"></div>
            <label for="type">Référence : </label>
            <input type="text" placeholder="Référence :" name="ref" value="<?= !empty($_POST['ref']) ?  $_POST['ref'] : '' ?>">
            <div class="erref"></div>
            <label for="type">Description (Zone de texte) </label>
            <input type="text" placeholder="blablabla" name="desc" value="<?= !empty($_POST['desc']) ?  $_POST['desc'] : '' ?>">
            <div class="erdesc"></div>
            <label for="image">Ajouter une image</label>
            <input type="file" placeholder="choisir une image" name="img" value="">
            <label for="image">Ajouter une image 2</label>
            <input type="file" placeholder="choisir une image" name="img2" value="">
            <label for="image">Ajouter une image 3</label>
            <input type="file" placeholder="choisir une image" name="img3" value="">
            <label for="image">Ajouter une image 4</label>
            <input type="file" placeholder="choisir une image" name="img4" value="">
            <label for="image">Ajouter une image 5</label>
            <input type="file" placeholder="choisir une image" name="img5" value="">
            <div class="erimg"></div>
            <button type="submit" name="Ajouter" value="1">Ajouter un materiel</button>
        </form>
    </div>
    <br>
    <?php

    if (!empty($_POST['Ajouter'])) {
        $img = isValidImage('img');
        $nom = isValid('nom');
        $type = isValid('type');
        $ref = isValid('ref');
        $desc = isValid('desc', false);
        /* recupere tout les image */

        if (!empty($nom) && !empty($type) && !empty($ref) && !empty($desc) && !empty($img)) {
            $img = getImage($_FILES['img']);
            if (!empty($_POST['img2'])) {
                getImage($_FILES['img2'], $img);
            }
            if (!empty($_POST['img3'])) {
                getImage($_FILES['img3'], $img);
            }
            if (!empty($_POST['img4'])) {
                getImage($_FILES['img4'], $img);
            }
            if (!empty($_POST['img5'])) {
                getImage($_FILES['img5'], $img);
            }
            execute("INSERT INTO `materiel`( `nom`, `type`, `reference`, `description`,`img`) VALUES (:nom,:type,:ref,:desc,:img);", [
                'nom' => $nom,
                'type' => $type,
                'ref' => $ref,
                'desc' => $desc,
                'img' => $img
            ]);
            echo "l'ajout a bien ete fait";
        }
    }

    /**
     * liste des demandes de réservation
     */
    ?>
    <div>
        <h2>Liste des demandes de réservation</h2>
        <table style="border:solid;">
            <tr>
                <th>Nom . prenom</th>
                <td>Date de debut . Date de fin de pret</td>
                <td>Type . nom du materiel</td>
                <td>Statut de la demande</td>
            </tr>

            <?php $result = execute(" SELECT utilisateur.nom AS usernom, utilisateur.prenom AS userprenom,  reservation.id as resid ,reservation.horraire_debut,reservation.horraire_fin, reservation.date, reservation.statut, materiel.type, materiel.nom AS materielnom FROM `reservation`, `materiel`, `utilisateur` WHERE reservation.id_utilisateur = utilisateur.id AND reservation.id_materiel = materiel.id;");
            if ($result->rowCount() > 0) {
                foreach ($result as $row) {

                    //SELECT utilisateur.nom as usernom, utilisateur.prenom as userprenom,demande.dateD,demande.dateF,demande.statut,materiel.type,materiel.nom as materielnom FROM `materiel`,`utilisateur`,`demande` WHERE demande.materielId = materiel.id AND utilisateur.id = demande.id_utilisateur;
                    if ($row['statut'] != "en attente") {

                        $statut =  $row['statut'];
                    } else {
                        $statut = "EN ATTENTE";

                        $statut .= "
                                <form action=" . basename(__FILE__) . " method='post'>
                                    <td>
                                        <button type='submit' onclick='" . statut("accepter") . "' name='accepter'value='{$row["resid"]}'>Accepter</button>
                                        <button type='submit' onclick='" . statut("refuser") . "'name='refuser' value='{$row["resid"]}'>Refuser</button>
                                    </td>
                                </form>";
                    }
                    echo "
                        <tr>
                            <td>" . $row['usernom'] . " . " . $row['userprenom'] . "</td>
                            <td>" . $row['date'] . " . " . "</td>
                            <td>" . $row['type'] . " . " . $row['materielnom'] . "</td>
                            <td>" . $statut . "<td>
                            <a href='detail-reservation.php?id={$row["resid"]}'>eeee</a>
                        </tr>";
                }
            }
            ?>
        </table>
    </div>
<?php
} else {
    header("Location: login.php");
}
include $path . "html/footer.php";
