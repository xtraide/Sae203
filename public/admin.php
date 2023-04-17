<?php
$path =   "../utile/";
include $path . "html/header.php";
include $path . "link/linkPdo.php";
session_start();
if (array_key_exists('role', $_SESSION) && $_SESSION['role'] ==  'admin') {
?>
    <div>
        <label for="ajout">Ajouter un materiel</label>
        <form action="admin.php" method="post">
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

    <?php
    include $path . "function.php";
    if (!empty($_POST['Ajouter'])) {
        $nom = isvalid('nom');
        $type = isvalid('type');
        $ref = isvalid('ref');
        $desc = isvalid('desc');
        if (!empty($nom) && !empty($type) && !empty($ref) && !empty($desc)) {
            execute("INSERT INTO `materiel`( `nom`, `type`, `reference`, `description`) VALUES (:nom,:type,:ref,:desc);", [
                'nom' => $nom,
                'type' => $type,
                'ref' => $ref,
                'desc' => $desc
            ]);
            echo 'DAME';
        }
    }
    ?>
    <div>
        <h3>liste des demandes de réservation</h3>
        <table style="border:solid;">
            <tr>
                <th>Nom . prenom</th>
                <td>Date de debut . Date de fin de pret</td>
                <td>Type . nom du materiel</td>
                <td>Statut de la demande</td>
            </tr>

            <?php $result = execute(" SELECT utilisateur.nom as usernom, utilisateur.prenom as userprenom,demande.dateD,demande.dateF,demande.statut,materiel.type,materiel.nom as materielnom FROM `materiel`,`utilisateur`,`demande` WHERE demande.materielId = materiel.id AND utilisateur.id = demande.id_utilisateur ;");
            if ($result->rowCount() > 0) {
                foreach ($result as $row) {
                    if (!empty($row['statut'])) {
                        $statut = $row['statut'];
                    } else {
                        $satut = "EN ATTENTE";
                    }
                    //SELECT utilisateur.nom as usernom, utilisateur.prenom as userprenom,demande.dateD,demande.dateF,demande.statut,materiel.type,materiel.nom as materielnom FROM `materiel`,`utilisateur`,`demande` WHERE demande.materielId = materiel.id AND utilisateur.id = demande.id_utilisateur;
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
} else {
    echo "gg";
    header("Location: login.php");
}
