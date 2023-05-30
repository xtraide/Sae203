<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = execute("SELECT * FROM `materiel` WHERE materiel.id = :id", [
        'id' => $id
    ]);
    if ($result->rowCount() > 0) {
        while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($row as $row) {
?>
                <div class="container">
                    <div class="slider">
                        <div class="bouton">
                            <div class="slider-line">
                                <?php $img = array_diff(scandir("../assets/ressources/materiel/" . $row['img']), [".", ".."]);
                                foreach ($img as $img) {
                                ?>
                                    <img src="../assets/ressources/materiel/<?= $row['img'] ?>/<?= $img ?>" alt=" image du materiel" class="img_matos">
                                <?php
                                } ?>

                            </div>
                            <button class="slider-prev">précédent</button>
                            <button class="slider-next" type="none">suivant</button>
                        </div>
                    </div>
                    <div class="modif_reserv">
                        <form action="<?= basename(__FILE__) . "?id=" . $id ?>" method="post">
                            <div class="description">
                                <p class="sNom">Nom : <?= $row['nom']; ?><input type="text" id="nom" class="modif none"></p>
                                <p class="sType">Type : <?= $row['type']; ?><input type="text" id="type" class="modif none"></p>
                                <p class="sRef">Reférence : <?= $row['reference']; ?><input type="text" id="reference" class="modif none"></p>
                                <p class="sDesc">Description : <?= $row['description']; ?><input type="text" id="description" class="modif none"></p>
                            </div>
                        </form>
                        <script src="../assets/js/script.js"></script>
                        <?php
                        /**
                         * admin part  pour modif les champs
                         */
                        if ($_SESSION['role'] == "admin") {
                        ?>
                            <div id="bouton">
                                <button name="submit" value="1" class="admin modifier" id="modifier">Modifiez</button>
                                <button name="submit" value="1" id="validmodif" class="none">
                                    <p class="hfnfrht"> Validez la modification</p>
                                </button>
                                <script>
                                    function switchInput() {
                                        modif.classList.toggle('none');
                                        validmodif.classList.toggle('none');
                                    }

                                    var validmodif = document.getElementById('validmodif');
                                    var modif = document.getElementById('modifier');
                                    modif.addEventListener("click", () => {
                                        var input = document.getElementsByTagName('input')
                                        for (i = 0; i < input.length; i++) {
                                            input[i].classList.toggle('none');
                                        }
                                        switchInput()
                                    })

                                    validmodif.addEventListener("click", () => {
                                        const forms = document.querySelectorAll('form');
                                        const form = forms[0];
                                        Array.from(form.elements).forEach((input) => {
                                            if (input.value != '') {
                                                fetch("<?= $path ?>function/editun.php?id=<?= $row['id'] ?>&table=" + input.id + "&value=" +
                                                        input.value)
                                                    .then(function() {
                                                        console.log("<?= $path ?>function/editun.php?id=<?= $row['id'] ?>&table=" + input.id + "&value=" +
                                                            input.value);
                                                        location.reload();
                                                    });
                                            }
                                        })
                                        switchInput()
                                    })
                                </script>
                            <?php
                        }
                            ?>
                            <form action="reservation.php" method="GET">
                                <button name="id_materiel" value="<?= $row['id']; ?>" class="admin">Reservez</button>
                            </form>
                            </div>
                    </div>
                </div>
<?php
            }
        }
    } else {
        echo "No results found.";
    }
}

include $path . "html/footer.php";
