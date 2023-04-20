<?php
$path =   "../utile/";
include $path . "html/header.php";
include $path . "link/linkPdo.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = execute("SELECT * FROM `materiel` WHERE materiel.id = :id", [
        'id' => $id
    ]);
    if ($result->rowCount() > 0) {
        while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($row as $row) {
                ?>
                <div class="itemcard">
                    <img src="../assets/ressources/400/<?= $row['img'] ?>.png" alt=" image du materiel" >
                    <p>id : <?= $row['id']; ?></p>
                    <p>nom : <?= $row['nom']; ?></p>
                    <p>Type : <?= $row['type']; ?></p>
                    <p>Refference : <?= $row['reference']; ?> </p>
                    <p>description : <?= $row['description']; ?></p>
                </div>
                <?php
            }
        }
    } else {

        echo "No results found.";

    }
}


?>