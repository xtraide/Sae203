<?php

function isvalid($post, $on = true)
{
    if (!empty($_POST[$post])) {
        if ($on) {
            switch ($post) {
                case 'mdp':
                    if (strlen($_POST[$post]) >= 6) {
                        return corect($_POST[$post]);
                    } else {
                        ?>
                        <script type="text/javascript">
                            document.getElementsByClassName('er<?= $post ?>')[0].innerHTML = 'Le mot de pass dois contenir au moin 6 caractere';
                        </script>
                    <?php
                    }
                    break;
                case 'email':
                    if (filter_var($_POST[$post], FILTER_VALIDATE_EMAIL)) {
                        return corect($_POST[$post]);
                    } else {
                    ?>
                        <script type="text/javascript">
                            document.getElementsByClassName('er<?= $post ?>')[0].innerHTML = "l'email saisie n'est pas un email valid";
                        </script>
                    <?php
                    }
                default:
                    return corect($_POST[$post]);
            }
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
