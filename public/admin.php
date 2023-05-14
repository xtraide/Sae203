<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php";


if (array_key_exists('role', $_SESSION) && $_SESSION['role'] ==  'admin') {
    /**
     * Ajouter un materiel 
     */
?>
    <div class="container">
        <form action="<?= basename(__FILE__); ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="ajout" class="label">Ajouter un materiel</label>

            </div>
            <div>
                <label for="Nom" class="label">Nom : </label>
            </div>
            <div>
                <input type="text" placeholder="Nom" class="input" name="nom" value="<?= !empty($_POST['nom']) ?  $_POST['nom'] : '' ?>">
            </div>
            <div class="ernom"></div>


            <div>
                <label for="type" class="label">Type : </label>
            </div>
            <div>
                <select class="input" placeholder="Type de materiel" class="input" name="type" value="<?= !empty($_POST['nom']) ?  $_POST['nom'] : '' ?>">
                    <option value="invalid">--Please choose an option--</option>
                    <option value="cam" class="option">Caméra</option>
                    <option value="mic" class="option">Micro</option>
                    <option value="pied" class="option">Tripied</option>
                    <option value="vert" class="option">Fond vert</option>
                </select>
            </div>
            <div class="ertype"></div>

            <div>
                <label for="type" class="label">Référence : </label>
            </div>
            <div>
                <input type="text" placeholder="Référence :" class="input" name="ref" value="<?= !empty($_POST['ref']) ?  $_POST['ref'] : '' ?>">
            </div>
            <div class="erref"></div>

            <div>
                <label for="type" class="label">Description (Zone de texte) </label>
            </div>
            <div>
                <input type="text" placeholder="blablabla" name="desc" class="input" value="<?= !empty($_POST['desc']) ?  $_POST['desc'] : '' ?>">
                <div class="erdesc"></div>
            </div>
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
            <button name="Ajouter" value="1" class="submit">Ajouter un materiel</button>

        </form>
    </div>

    <br>
    <?php

    if (!empty($_POST['Ajouter'])) {

        $img = isValidImage('img');
        var_dump($img);
        $nom = isValid('nom');
        $type = isValid('type');
        $ref = isValid('ref');
        $desc = isValid('desc');
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
    <div class="tableau">
        <h3>liste des demandes de réservation</h3>
        <table>
            <tr class="tr">
                <th>Nom . prenom</th>
                <td class="td">Date de debut . Date de fin de pret</td>
                <td class="td">Type . nom du materiel</td>
                <td class="td">Statut de la demande</td>
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
                        <tr class=tr>
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
include $path . "html/footer.php";
//ajt 2bouton pour refu ou accepter