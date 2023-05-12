<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['id'])) {
        echo $_GET['token'] . "1<br>2" . $_COOKIE['token'];
        if ($_GET['token'] == $_COOKIE['token']) {
            $path =   "../utile/";
            include $path . 'function.php';
            include $path . 'link/linkPdo.php';
            $id = $_GET['id'];
            setcookie("id", $row['id'], time() + 604800, '/');
            execute("UPDATE `utilisateur` SET `verified`='1' WHERE id = :id", [
                "id" => $id
            ]);
            unset($_COOKIE['token']);
            setcookie('token', null, -1, '/');
            header("Location: index.php");
        }
    }
}
include $path . "html/footer.php";
