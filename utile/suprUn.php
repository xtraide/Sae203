<?php function suprUnUser(string $idUser)
{
    execute("DELETE  FROM `utilisateur` WHERE id = :id", [
        "id" => $idUser
    ]);
    header('Location: ../utile/link/deco.php');
}
