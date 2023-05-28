<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php"; ?>

<div id="flex">
<div>
 <p id="titre">Réserver </br> dès maintenant </br> du matériel</p>

    <button  id="bouton"   ><a href="../public/index.php">
        <span> retour à l'accueil</span>
        <span  id="fleche">></span>
    </a>
    </button>

</div>
<div id="cam"><img id="camimg" src="../assets/ressources/utile/navimg/cam.png" alt="camera"></div>
</div>

<?php
echo  "<br>";
$result = execute("SELECT * FROM materiel");
if ($result->rowCount() > 0) {
    while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($row as $row) {

?>
            <a href="detail.php?id=<?= $row['id'] ?>">
                <img src="../assets/ressources/materiel/<?= $row['img']; ?>/<?= $row['imghead']; ?>" alt=" image du materiel">
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