<?php function suprUnUser(string $idUser)
{
    include '../link/linkPdo.php';
    execute("DELETE  FROM `utilisateur` WHERE id = :id", [
        "id" => $idUser
    ]);
    header('Location: ../utile/link/deco.php');
}
suprUnUser($_GET['id']);
