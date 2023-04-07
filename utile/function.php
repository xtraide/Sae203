<?php

function isempty($post)
{
    if (!empty($_POST[$post])) {
        $info = htmlentities(trim($_POST['nom']));
        return $info;
    } else {
        echo "Le champs " . $post . " n'a pas ete rempli";
    }
}
?>