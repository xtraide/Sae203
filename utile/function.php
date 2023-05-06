<?php


function isValid($post, $on = true)
{
    if (!empty($_POST[$post])) {
        if ($on) {
            switch ($post) {
                case 'mdp':

                    if ($_POST[$post] == $_POST['valid' . $post]) {
                        if (strlen($_POST[$post]) >= 6) {
                            return corect($_POST[$post]);
                        } else {
?>
                            <script type="text/javascript">
                                document.getElementsByClassName('er<?= $post ?>')[0].innerHTML = 'Le mot de passe doit contenir au moins 6 caractères';
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script type="text/javascript">
                            document.getElementsByClassName('valid<?= $post ?>')[0].innerHTML = 'le mot de passe et la confirmation sont differents';
                        </script>
                        <?php
                    }
                    break;

                case 'email':

                    if (filter_var($_POST[$post], FILTER_VALIDATE_EMAIL)) {

                        $email = corect($_POST[$post]);

                        $result = execute("SELECT * FROM `utilisateur` WHERE email =:email", [
                            'email' => $email
                        ]);
                        if ($result->rowCount() == 0) {
                            return corect($_POST[$post]);
                        } else {
                        ?>
                            <script>
                                document.getElementsByClassName('eremail')[0].innerHTML = "l'e-mail deja pris";
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script type="text/javascript">
                            document.getElementsByClassName('er<?= $post ?>')[0].innerHTML = "l'e-mail saisi n'est pas un e-mail valide";
                        </script>
        <?php
                    }
                    break;


                default:
                    return corect($_POST[$post]);
            }
        } else {
            return corect($_POST[$post]);
        }
    } else {
        ?>
        <script type="text/javascript">
            document.getElementsByClassName('er<?= $post ?>')[0].innerHTML = 'Le champ <?= $post ?> est vide 😃 😅 😨 💩';
        </script>
    <?php
    }
}
function crypte($text)
{
    $hash_text = hash("sha256", $text);
    return $hash_text;
}
function corect($input)
{
    return htmlspecialchars(strip_tags($input));
}

function isConflitHorraire($heure_debut_nouvelle, $heure_fin_nouvelle, $date, $materiel)
{
    /**
     * recuperer le nombre de  materiel disponible dans la base par rapport au quantiter
     */
    $result = execute("SELECT DISTINCT (SELECT quantite.quantite FROM `quantite` WHERE quantite.id_materiel = :materiel) - (SELECT COUNT(reservation.id_materiel)  FROM `reservation` WHERE reservation.id_materiel = :materiel)  as nb FROM `reservation`,`quantite` WHERE 1;", [
        'materiel' => $materiel
    ]);
    while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
        $count = $row[0]['nb'];
        if ($count <= 0) {
            return true;
            echo "le materiel n'es pas disponible sur la periode demander ";
        }
    }


    /***************************
     *  recuperation des horraire dans la bdd == reservations_bdd
     ***************************/

    $result = execute("SELECT horraire_debut,horraire_fin FROM `reservation`,`materiel` WHERE reservation.id_materiel = materiel.id AND reservation.date = :date AND materiel.id = :id_materiel ;", [
        'date' => $date,
        'id_materiel' => $materiel
    ]);
    $reservations_bdd = [];
    while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {

        foreach ($row as $row) {

            $debut = $row['horraire_debut'];
            $fin = $row['horraire_fin'];
            array_push(
                $reservations_bdd,
                array('heure_debut' => $debut, 'heure_fin' => $fin)
            );
        }
    }
    /***************************
     *  comparaison avec les heur de la bdd 
     ***************************/
    if (!empty($reservations_bdd)) {

        foreach ($reservations_bdd as $reservation) {

            $heure_debut_bdd  = $reservation['heure_debut'];
            $heure_fin_bdd = $reservation['heure_fin'];

            // Vérifier si l'heure de début de la nouvelle réservation est entre l'heure de début et l'heure de fin de la réservation existante
            if ($heure_debut_nouvelle >= $heure_debut_bdd && $heure_debut_nouvelle < $heure_fin_bdd) {
                return true; // Il y a un conflit
            }
            // Vérifier si l'heure de fin de la nouvelle réservation est entre l'heure de début et l'heure de fin de la réservation existante
            if ($heure_fin_nouvelle > $heure_debut_bdd && $heure_fin_nouvelle <= $heure_fin_bdd) {
                return true;
            }
            // Vérifier si l'heure de début de la nouvelle réservation est avant l'heure de début de la réservation existante et que l'heure de fin de la nouvelle réservation est après l'heure de fin de la réservation existante
            if ($heure_debut_nouvelle < $heure_debut_bdd && $heure_fin_nouvelle > $heure_fin_bdd) {
                return true;
            }
        }
    }

    return false; //  pas de conflit
}

/***************************
 *  accepter ou refuser le statut d'une reservation par raport a son id  
 ***************************/
function statut($post)
{
    if (!empty($_POST[$post])) {
        execute("UPDATE `reservation` SET `statut`=:accepter WHERE reservation.id = :id;", [
            "id" => $_POST[$post],
            "accepter" => $post
        ]);
        header("Refresh:0");
    }
}
function editUn($id, $post)
{
    $postcut = substr($post, 2);

    execute("UPDATE materiel SET {$postcut} =:nom WHERE id = :id", [
        "id" => $id,
        "nom" => htmlspecialchars($_POST[$post])
    ]);
    header("Refresh:0");
}
function isValidImage(String $img)
{
    $validFileSize = 9000000;
    $validExt = array("jpeg", "jpg", "png");
    $fileSize = $_FILES[$img]['size'];
    $fileName = $_FILES[$img]["name"];
    $fileExt = strtolower(substr(strrchr($fileName, '.'), 1));
    $er = true;
    if ($_FILES[$img]['error'] > 0) {
    ?>
        <script type="text/javascript">
            document.getElementsByClassName('erimg')[0].innerHTML = "ereeur";
        </script>
    <?php
        $er = false;
    }
    if (!in_array($fileExt, $validExt)) {
    ?>
        <script type="text/javascript">
            document.getElementsByClassName('erimg')[0].innerHTML = "fichier trop gros";
        </script>
    <?php
        $er = false;
    }

    if ($fileSize > $validFileSize) {
    ?>
        <script type="text/javascript">
            document.getElementsByClassName('erimg')[0].innerHTML = "fichier trop gros";
        </script>
<?php
        $er = false;
    }

    if ($er) {
        return $_FILES[$img];
    }
}
function getImage()
{
    $fileName = $_FILES['img']["name"];
    $tmpName = $_FILES['img']['tmp_name'];
    $uniqueName = md5(uniqid(rand()));
    $fileExt = "." . strtolower(substr(strrchr($fileName, '.'), 1));
    $fileName = "../assets/ressources/upload/" . $uniqueName . $fileExt;
    move_uploaded_file($tmpName, $fileName);
    $Newsize = getSize();
    var_dump($Newsize);
    $size = getimagesize($fileName);
    foreach ($Newsize as $Newsize) {
        $thumb = imagecreatetruecolor($Newsize, $Newsize);
        switch ($size['mime']) {

            case 'image/jpeg':

                $source = imagecreatefromjpeg($fileName);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $Newsize, $Newsize, $size[0], $size[1]);
                imagejpeg($thumb, "../assets/ressources/materiel/{$Newsize}/" . $uniqueName . $fileExt);

                break;
            case 'image/png':
                $source = imagecreatefromjpeg($fileName);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $Newsize, $Newsize, $size[0], $size[1]);
                imagepng($thumb, "../assets/ressources/{$Newsize}/" . $fileName);
                break;
            default:
        }
    }
    return   $uniqueName . $fileExt;
}
function getSize()
{
    return  array_diff(scandir("../assets/ressources/materiel"), [".", ".."]);
}
