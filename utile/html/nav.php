<?php
$result = execute("SELECT nom,prenom,role FROM `utilisateur` where utilisateur.id = '" . $_COOKIE['id'] . "';");
if ($result->rowCount() > 0) {
    while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($row as $row) {
?>
            <div class="hero">
                <nav class="navbar">

                    <a href="index.php"><img src="../assets/ressources/utile/navimg/iutLogo.png" alt="" height="65px" class="iut"></a>
                    <ul class="nav-links">
                        <li><a href="list-reservation.php">RESERVATION</a></li>
                        <li><a href="about.php">A PROPOS DE NOUS</a></li>
                        <?= $row['role'] == 'admin' ? '<li><a href="admin.php">' .  strtoupper($row['role']) . '</a></li>' : '' ?>
                    </ul>

                    <img src="../assets/ressources/utile/navimg/pp.png" alt="photo utilisateur" class="user-pic" onclick="toggleMenu()">

                    <div class="sub-menu-wrap" id="submenu">
                        <div class="sub-menu">
                            <div class="user-info">
                                <img src="../assets/ressources/utile/navimg/pp.jpg" alt="">
                                <p id="name"><?= $row['nom'] . ' ' . $row['prenom']; ?></p>
                            </div>
                            <a href="compte.php" class="sub-menu-link">
                                <img src="../assets/ressources/utile/navimg/logo_pp.png" alt="">
                                <p class="navtexte">profile</p>
                                <span><img src="../assets/ressources/utile/navimg/fleche_droite.png" alt=""></span>
                            </a>
                            <a href="../utile/link/deco.php" class="sub-menu-link">
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

?>
<script type="text/javascript" src="../assets/js/nav.js"></script>