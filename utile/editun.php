<?php
$path =   "../utile/";
include "../utile/link/linkPdo.php";
include "../utile/function.php";
$table = $_GET['table'];
$post = htmlspecialchars($_GET['value']);
$id = $_GET['id'];
execute("UPDATE materiel SET {$table} =:nom WHERE id = :id", [
    "id" => $id,
    "nom" => $post
]);
