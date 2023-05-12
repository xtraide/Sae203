<div class="hero">
        <nav class="navbar">

            <img src="../../assets/ressources/utile/iutLogo.png" alt="" height="65px" class="iut">
            <ul class="nav-links">
                <li class="search">
                    <input type="text" placeholder="Recherche" value="" class="reinput" name="recherche"></li>
                <li><a href="">RESERVATION</a></li>
                <li><a href="">A PROPOS DE NOUS</a></li>
            </ul>



            <img src="../../assets/ressources/nav/pp.png" alt="photo utilisateur" class="user-pic" onclick="toggleMenu()">


            <div class="sub-menu-wrap" id="submenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="../../assets/ressources/nav/pp.png" alt="">
                    </div>

                    <hr>

                    <a href="" class="sub-menu-link">
                        <img src="../../assets/ressources/nav/logo_pp.png" alt="">
                        <p>profile</p>
                        <span><img src="../../assets/ressources/nav/fleche_droite.png" alt=""></span>
                    </a>
                    <a href="" class="sub-menu-link">
                        <img src="../../assets/ressources/nav/logo_para.png" alt="">
                        <p>paramètre</p>
                        <span><img src="../../assets/ressources/nav/fleche_droite.png" alt=""></span>
                    </a>
                    <a href="" class="sub-menu-link">
                        <img src="../../assets/ressources/nav/log_out.jpg" alt="">
                        <p>deconexion</p>
                        <span><img src="../../assets/ressources/nav/fleche_droite.png" alt=""></span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <script src="../../assets/js/nav.js"></script>

<?php
$array = scandir("../public/");/*, [
    ".",
    "..",
    "detail.php",
    "admin.php",
    "verif.php",
    "404.php",
    "login.php",
    "sign-in.php"
]);*/

foreach ($array as $test) {
?>

    <a href="<?= $test ?>"><?= $test ?></a> <br>
<?php
} ?>