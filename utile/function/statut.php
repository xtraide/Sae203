<?php

function statut($post, $id)
{
    include '../link/linkPdo.php';

    execute("UPDATE `reservation` SET `statut`=:accepter WHERE reservation.id = :id;", [
        "id" => $id,
        "accepter" => $post
    ]);
}
statut($_GET['statut'], $_GET['id']);
