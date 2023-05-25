<?php
$result = execute("SELECT nom,prenom FROM `utilisateur` where utilisateur.id = '" . $_COOKIE['id'] . "';");
if ($result->rowCount() > 0) {
    while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($row as $row) {
?>
            <div class="hero">
                <nav class="navbar">

                    <img src="../assets/ressources/utile/navimg/iutLogo.png" alt="" height="65px" class="iut">
                    <ul class="nav-links">
                        <li class="search">
                            <input type="text" placeholder="Recherche" value="" class="reinput" name="recherche">
                        </li>
                        <li><a href="">RESERVATION</a></li>
                        <li><a href="">A PROPOS DE NOUS</a></li>
                    </ul>

                    <img src="../assets/ressources/utile/navimg/pp.png" alt="photo utilisateur" class="user-pic" onclick="toggleMenu()">

                    <div class="sub-menu-wrap" id="submenu">
                        <div class="sub-menu">
                            <div class="user-info">
                                <img src="../assets/ressources/utile/navimg/pp.jpg" alt="">
                                <p><?= $row['nom'] . ' ' . $row['prenom']; ?></p>
                            </div>

                            <a href="" class="sub-menu-link">
                                <img src="../assets/ressources/utile/navimg/logo_pp.png" alt="">
                                <p class="navtexte">profile</p>
                                <span><img src="../assets/ressources/utile/navimg/fleche_droite.png" alt=""></span>
                            </a>
                            <a href="" class="sub-menu-link">
                                <img src="../assets/ressources/utile/navimg/logo_para.png" alt="">
                                <p class="navtexte">paramètre</p>
                                <span><img src="../assets/ressources/utile/navimg/fleche_droite.png" alt=""></span>
                            </a>
                            <a href="" class="sub-menu-link">
                                <img src="../assets/ressources/utile/navimg/log_out.jpg" alt="">
                                <p class="navtexte">deconexion</p>
                                <span><img src="../assets/ressources/utile/navimg/fleche_droite.png" alt=""></span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>

    <?php
        }
    }
}



$array = scandir("../public/");

foreach ($array as $test) {
    ?>

    <a href="<?= $test ?>"><?= $test ?></a> <br>
<?php
} ?>
<script type="text/javascript" src="../assets/js/nav.js"></script>