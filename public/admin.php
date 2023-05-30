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
            <div>
                <label for="type" class="label">quantite</label>
            </div>
            <div>
                <input type="number" placeholder="quantite" name="quantite" class="input" value="<?= !empty($_POST['quantite']) ?  $_POST['quantite'] : '' ?>">
                <div class="erdesc"></div>
            </div>
            <div class="label2">
                <div class="ajt_img">
                    <label for="image">Ajouter une principale(Image aficher dans l'a liste de materiel)</label>
                    <input type="file" placeholder="choisir une image" name="img">
                </div>
                <div class="ajt_img">
                    <label for="image">Ajouter une image 2</label>
                    <input type="file" placeholder="choisir une image" name="img2">
                </div>
                <div class="ajt_img">
                    <label for="image">Ajouter une image 3</label>
                    <input type="file" placeholder="choisir une image" name="img3">
                </div>
                <div class="ajt_img">
                    <label for="image">Ajouter une image 4</label>
                    <input type="file" placeholder="choisir une image" name="img4">
                </div>
                <div class="ajt_img">
                    <label for="image">Ajouter une image 5</label>
                    <input type="file" placeholder="choisir une image" name="img5">
                </div>
                <div class="erimg"></div>
            </div class="ajt_img">
            <button name="Ajouter" value="1" class="submit">Ajouter un materiel</button>

        </form>
    </div>

    <br>
    <?php

    if (!empty($_POST['Ajouter'])) {
        $quantite = isValid('quantite');
        $img = isValidImage('img');
        $nom = isValid('nom');
        $type = isValid('type');
        $ref = isValid('ref');
        $desc = isValid('desc');
        /* recupere tout les image */

        if (!empty($nom) && !empty($type) && !empty($ref) && !empty($desc) && !empty($img)) {
            $img = getImage($_FILES['img'], '', true);
            if (!empty($_FILES['img2'])) {
                getImage($_FILES['img2'], $img[0]);
            }
            if (!empty($_FILES['img3'])) {
                getImage($_FILES['img3'], $img[0]);
            }
            if (!empty($_FILES['img4'])) {
                getImage($_FILES['img4'], $img[0]);
            }
            if (!empty($_FILES['img5'])) {
                getImage($_FILES['img5'], $img[0]);
            }
            execute("INSERT INTO `materiel`( `nom`, `type`, `reference`, `description`,`img`,`imghead`) VALUES (:nom,:type,:ref,:desc,:img,:imghead);", [
                'nom' => $nom,
                'type' => $type,
                'ref' => $ref,
                'desc' => $desc,
                'img' => $img[0],
                'imghead' => $img[1]
            ]);
            execute("INSERT INTO `quantite`(`quantite`,`id_materiel`) VALUES(:quantite,(SELECT MAX(id) FROM `materiel`))", [
                'quantite' => $quantite
            ]);
        }
    }
    /**
     * liste des demandes de réservation
     */
    ?>
    <div class="tableau">
        <h3>liste des demandes de réservation</h3>
        <?php
        $page = basename(__FILE__);
        require_once('../utile/html/table.php'); ?>
    </div>
<?php
} else {
    echo "gg";
    header("Location: login.php");
}
include $path . "html/footer.php";
//ajt 2bouton pour refu ou accepter