<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/detail.css">
    <title>Document</title>
</head>

<body>
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
    <div class="container">
        <div class="slider">
            <div class="visu">
                <div class="slider-line">
                    <img src="../assets/ressources/materiel/400/<?= $row['img'] ?>" alt=" image du materiel"width="1024px" height="576px"  name="1">
                    <img src="2.png" width="1024px" height="576px" alt="2" name="2">
                    <img src="3.png" width="1024px" height="576px" alt="3" name="3">
                </div>
                <div class="bouton-slide">
                    <div>
                        <button class="slider-prev">prece</button>
                    </div>
                    <div>
                        <button class="slider-next">next</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="info">
            <form action="<?= basename(__FILE__) . "?id=" . $id ?>" method="post">
                <div class="itemcard">

                    <p class="sId">id : <?= $row['id']; ?></p>
                    <p class="sNom">nom : <?= $row['nom']; ?> <input type="text" name="monom" class="monom none"></p>
                    <p class="sType">Type : <?= $row['type']; ?> <input type="text" name="motype" class="motype none">
                    </p>
                    <p class="sRef">Refference : <?= $row['reference']; ?> <input type="text" name="moref"
                            class="moref none"></p>
                    <p class="sDesc">description : <?= $row['description']; ?> <input type="text" name="modesc"
                            class="modesc none"></p>

                        </form>
                        <form action="reservation.php" method="post">
                            <button name="id" value="<?= $row['id']; ?>" class="reserv">Reserver</button>
                        </form>
                </div>
        </div>

    </div>

    <?php

    /**
     * admin part  pour modif les champs
     */
    if ($_SESSION['role'] == "admin") {
    ?>
    <div class="admin">
        <button name="submit" value="1" id="modifier">Modifier</button>
    </div>

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
    
<?php
            }
        }
    } else {

        echo "No results found.";
    }
}

include $path . "html/footer.php";
?>

    <script src="nav.js"></script>
</body>

</html>