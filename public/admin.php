<?php
$path =   "../utile/";
include $path . "html/header.php";
include $path . "link/linkPdo.php";
include $path . "function.php";
session_start();
if (array_key_exists('role', $_SESSION) && $_SESSION['role'] ==  'admin') {
    /**
     * Ajouter un materiel 
     */
?>
    <div>
        <label for="ajout">
            <h2>Ajouter un materiel</h2>
        </label>
        <form action="<?= basename(__FILE__); ?>" method="post">
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
            <button type="submit" name="Ajouter" value="1">Ajouter un materiel</button>
        </form>
    </div>
    <br>
    <?php

    if (!empty($_POST['Ajouter'])) {
        $nom = isValid('nom');
        $type = isValid('type');
        $ref = isValid('ref');
        $desc = isValid('desc');
        if (!empty($nom) && !empty($type) && !empty($ref) && !empty($desc)) {
            execute("INSERT INTO `materiel`( `nom`, `type`, `reference`, `description`) VALUES (:nom,:type,:ref,:desc);", [
                'nom' => $nom,
                'type' => $type,
                'ref' => $ref,
                'desc' => $desc
            ]);
            echo 'sa a marche';
        }
    }
    /*
     * Modification  d'un materiel
     * a refaire avec les autre 
     */
    ?> <div>
        <label for="ajout">
            <h2>Modification d'un materiel</h2>
        </label>
        <form action="<?= basename(__FILE__); ?>" method="post">
            <label for="type">Référence de l'objet a modifier</label>
            <input type="text" placeholder="Référence :" name="refe" value="<?= !empty($_POST['ref']) ?  $_POST['ref'] : '' ?>">
            <div class="errefe"></div>
            <label for="">quelle partie voulez vous modifiez</label>
            <select name="option">
                <option value="nom">nom</option>
                <option value="type">type</option>
                <option value="reference">reference</option>
                <option value="description">description</option>
            </select>
            <button type="submit" name="Modifier" value="1">Modifier un materiel</button>
        </form>
    </div>

    <?php
    if (!empty($_POST['Modifier']) && $_POST['Modifier'] == "1") {
        $refe = isValid('refe');
        $option = isValid('option');
    }
    if (!empty($option) && !empty($refe)) {
        $result = execute("SELECT {$option} FROM `materiel` WHERE `reference` = :ref", [
            'ref' => $refe
        ]);
        if ($result->rowCount() > 0) {
    ?>
            <form action="<?= basename(__FILE__); ?>" method="post">
                <label for="">Modifier le champ</label>
                <input type="text" name="before" id="before">
                <div class="erbefore"></div>
                <button name="changed" type="submit" value="1">enregistrer les modification</button>
            </form>
            <?php
            while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
                foreach ($row as $row) {
            ?>
                    <script>
                        document.getElementById('before').value = '<?= $row[$option]; ?>';
                        document.getElementById('changed').addEventListener("click", () => {
                            <?php $result = execute("UPDATE `materiel` SET `{$option}` = :before WHERE reference = :ref", [
                                'before' => $before,
                                'ref' => $refe
                            ]); ?>
                        });
                    </script>
    <?php
                }
            }
        } else {
            echo "la reference n'est pas bonne";
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
    echo "gg";
    header("Location: login.php");
}
