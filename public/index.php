<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php"; ?>

<div id="flex">
    <div>
        <p id="titre">Réservez <br> dès maintenant <br> du matériel</p>
        <button id="bouton" onclick="scrollToDestination()">>
            <span>Commencez ici</span>
            <span id="fleche">></span>

        </button>
    </div>
    <div id="cam"><img id="camimg" src="../assets/ressources/utile/navimg/cam.png" alt="camera"></div>
</div>
<a id="destination"></a>
<div class="container">
    <?php
    $result = execute("SELECT * FROM materiel");
    if ($result->rowCount() > 0) {
        while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($row as $row) {
    ?>
                <div class="itemcard">
                    
                    <a href="detail.php?id=<?= $row['id'] ?>">
                        <img src="../assets/ressources/materiel/<?= $row['img']; ?>/<?= $row['imghead']; ?>" alt="image du materiel" class="img_card">
                        <p class="margin">Nom : <?= $row['nom']; ?></p>
                        <p class="margin">Type : <?= $row['type']; ?></p>
                        <p class="margin">Référence : <?= $row['reference']; ?> </p>
                        <p class="texte margin">Description : <?= $row['description']; ?></p>
                        </a>
                </div>
               
                <script>
                    function scrollToDestination() {
                        var destinationElement = document.getElementById("destination");
                        destinationElement.scrollIntoView({
                            behavior: "smooth"
                        });
                    }
                </script>
        <?php
            }
        }
        ?>
</div>
<?php
    } else {

        echo "No results found. ";
    }
    include "../utile/html/footer.php";
?>