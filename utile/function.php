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
                                document.getElementsByClassName('er<?= $post ?>')[0].innerHTML = 'Le mot de pass dois contenir au moin 6 caractere';
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script type="text/javascript">
                            document.getElementsByClassName('valid'
                                <?= $post ?>)[0].innerHTML = 'le mot de passe et la confirmation son different';
                        </script>
                        <?php
                    }
                    break;

                case 'email':

                    if (filter_var($_POST[$post], FILTER_VALIDATE_EMAIL)) {
                        $result = execute("SELECT count(email) as nbemail  from `utilisateur` WHERE email ='" . $_POST[$post] . "'");
                        if (mysqli_num_rows($result) == 0) {
                            return corect($_POST[$post]);
                        } else {
                        ?>
                            <script>
                                document.getElementsByClassName('eremail')[0].innerHTML = "l'email deja pris";
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script type="text/javascript">
                            document.getElementsByClassName('er<?= $post ?>')[0].innerHTML = "l'email saisie n'est pas un email valid";
                        </script>
                        <?php
                    }
                    break;
                default:
                    return corect($_POST[$post]);
            }
        }else{
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
