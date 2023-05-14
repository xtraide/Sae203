<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php";

echo  "<br>";
$result = execute("SELECT * FROM materiel");
if ($result->rowCount() > 0) {
    while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($row as $row) {
?>
            <a href="detail.php?id=<?= $row['id'] ?>">
                <img src="../assets/ressources/materiel/250/<?= $row['img']; ?>" alt=" image du materiel">
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

    echo "No results found. ";
}

include "../utile/html/footer.php";
?>