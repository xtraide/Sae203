<?php
$path =   "../utile/";
include $path . "html/header.php";
include $path . "link/linkPdo.php";
session_start();

if ($_SESSION['role'] == 'admin') {
}

$result = execute("SELECT * FROM materiel");
if ($result->rowCount() > 0) {
    while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($row as $row) {
            ?>
            <a href="detail.php?id=<?= $row['id'] ?>">
            <img src="../assets/ressources/250/<?= $row['img'];?>.png" alt=" image du materiel">
                <div class="itemcard">
                    <p>nom : <?= $row['nom']; ?></p>
                    <p>Type : <?= $row['type']; ?></p>
                    <p>Refference : <?= $row['reference']; ?> </p>
                    <p>description : <?= $row['description']; ?></p>
                </div>
            </a>
<?php
        }
    }
} else {
    echo "No results found.";
}


include "../utile/html/footer.php";
?>