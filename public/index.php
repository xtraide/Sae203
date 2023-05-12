<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/index.css">
    <title>Document</title>
</head>
<?php
$path =   "../utile/";
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
<body>
    <div class="herp">
        <nav class="navbar">

            <h2 class="logo"> LINK</h2>
            <ul class="nav-links">
                <li class="search">
                    <input type="text" placeholder="Recherche" value="" class="reinput" name="recherche"></li>
                <li><a href="">RESERVATION</a></li>
                <li><a href="">A PROPOS DE NOUS</a></li>
            </ul>



            <img src="asset/images/pp.jpg" alt="photo utilisateur" class="user-pic" onclick="toggleMenu()">


            <div class="sub-menu-wrap" id="submenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="asset/images/pp.png" alt="">
                        <h3>Nico</h3>
                    </div>

                    <hr>

                    <a href="" class="sub-menu-link">
                        <img src="asset/images/logo_pp.png" alt="">
                        <p>profile</p>
                        <span><img src="asset/images/fleche_droite.png" alt=""></span>
                    </a>
                    <a href="" class="sub-menu-link">
                        <img src="asset/images/logo_para.png" alt="">
                        <p>paramètre</p>
                        <span><img src="asset/images/fleche_droite.png" alt=""></span>
                    </a>
                    <a href="" class="sub-menu-link">
                        <img src="asset/images/log_out.jpg" alt="">
                        <p>deconexion</p>
                        <span><img src="asset/images/fleche_droite.png" alt=""></span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <div class="titre">
        <p>VIDEO</p>
    </div>
    <div class="container">
        <div>
            <button class="prece"><</button>
        </div>
        <div class="produit">
            <img src="asset/images/cam.png" alt="3mos full hd" class="images">
            <p>3mos full hd</p>
            <button class="voir"><a href="">Voir le produit</a></button>
        </div>
        <div class="produit">
            <img src="asset/images/cam.png" alt="3mos full hd" class="images">
            <p>3mos full hd</p>
            <button class="voir"><a href="">Voir le produit</a></button>
        </div>
        <div class="produit">
            <img src="asset/images/cam.png" alt="3mos full hd" class="images">
            <p>3mos full hd</p>
            <button class="voir"><a href="">Voir le produit</a></button>
        </div>
        <div><button class="suivant">></button>
        </div>
    </div>
    
    <div class="titre">
        <p>AUDIO</p>
    </div>
    <div class="container">
        <div>
            <button class="prece"><</button>
        </div>
        <div class="produit">
            <img src="asset/images/mic.png" alt="3mos full hd" class="mic">
            <p>Micro MP3</p>
            <button class="voir"><a href="">Voir le produit</a></button>
        </div>
        <div class="produit">
            <img src="asset/images/mic.png" alt="3mos full hd" class="mic">
            <p>Micro MP3</p>
            <button class="voir"><a href="">Voir le produit</a></button>
        </div>
        <div class="produit">
            <img src="asset/images/mic.png" alt="3mos full hd" class="mic">
            <p>Micro MP3</p>
            <button class="voir"><a href="">Voir le produit</a></button>
        </div>
        <div><button class="suivant">></button>
        </div>
    </div>





</body>
</html>
