<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['id'])) {
        $path =   "../utile/";
        include $path . 'function.php';
        include $path . 'link/linkPdo.php';
        $id = $_GET['id'];
        setcookie("id", $row['id'], time() + 604800, '/');
        execute("UPDATE `utilisateur` SET `verified`='1' WHERE id = :id", [
            "id" => $id
        ]);

        header("Location: index.php");
    }
}
