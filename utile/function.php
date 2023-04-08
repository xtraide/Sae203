<?php

function isempty($post)
{
    if (!empty($_POST[$post])) {
        return isvalid($_POST[$post]);
    } else {
        echo "Le champs " . $post . " n'a pas ete rempli";
    }
}
function crypt($text)
{
    $hash_text = hash("sha256", $text);
    return $hash_text;
}
function isvalid($input)
{
    return htmlentities(trim($input));
}
