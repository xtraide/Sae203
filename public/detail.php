<?php
$path =   "../utile/";
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
                <form action="<?= basename(__FILE__) . "?id=" . $id ?>" method="post">
                    <div class="itemcard">

                        <img src="../assets/ressources/materiel/400/<?= $row['img'] ?>" alt=" image du materiel">
                        <p class="sId">id : <?= $row['id']; ?></p>
                        <p class="sNom">nom : <?= $row['nom']; ?> <input type="text" name="monom" class="monom none"></p>
                        <p class="sType">Type : <?= $row['type']; ?> <input type="text" name="motype" class="motype none"></p>
                        <p class="sRef">Refference : <?= $row['reference']; ?> <input type="text" name="moref" class="moref none"></p>
                        <p class="sDesc">description : <?= $row['description']; ?> <input type="text" name="modesc" class="modesc none"></p>
                    </div>

                    <?php

                    /**
                     * admin part  pour modif les champs
                     */
                    if ($_SESSION['role'] == "admin") {
                    ?>
                        <button name="submit" value="1" id="modifier">Modifier</button>
                        <script>
                            var input = document.getElementsByTagName('input')
                            for (i = 0; i < input.length; i++) {
                                input[i].classList.toggle('none');
                            }
                        </script>
                    <?php
                        if (!empty($_POST['submit'])) {
                            if (!empty($_POST['monom'])) {
                                editUn($row['id'], "monom");
                            }
                            if (!empty($_POST['motype'])) {
                                editUn($row['id'], "motype");
                            }
                            if (!empty($_POST['moref'])) {
                                editUn($row['id'], "moref");
                            }
                            if (!empty($_POST['modesc'])) {
                                editUn($row['id'], "modesc");
                            }
                        }
                    }
                    ?>
                </form>
                <form action="reservation.php" method="get">
                    <button name="id" value="<?= $row['id']; ?>">Reserver</button>
                </form>
<?php
            }
        }
    } else {

        echo "No results found.";
    }
}


?>