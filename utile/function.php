<?php
function isvalid($post, $on = true)
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
                        $result = execute("SELECT email  from `utilisateur` WHERE email =':email'", [
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
            document.getElementsByClassName('er<?= $post ?>')[0].innerHTML = 'Le champ <?= $post ?> est vide';
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
    return htmlentities(trim($input));
}

function verifConflit($heure_debut_nouvelle, $heure_fin_nouvelle, $date, $materiel)
{
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
