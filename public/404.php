<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php"; ?>

<div id="suite">
    <p id="top">404</p>
    <p>Page introuvable</p>
    <p id="erreur">UNE ERREUR EST SURVENU</p>


    <button id="bouton"><a href="../public/index.php">
            <span> retour à l'accueil</span>
            <span id="fleche">></span>
        </a>
    </button>
</div>
</a><?php
    include $path . "html/footer.php";
    ?>