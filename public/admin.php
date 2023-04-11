<?php
$path =   "../utile/";
include $path . "html/header.php";
include $path . "link/link.php";
?>
<div>
    <label for="ajout">Ajouter un materiel</label>
    <form action="admin.php" method="post">
        <label for="Nom">Nom : </label>
        <input type="text" placeholder="Nom" name="nom" value="<?= !empty($_POST['nom']) ?  $_POST['nom'] : '' ?>">
        <div class="ernom"></div>
        <label for="type">Type : • Type (Liste déroulante)</label>
        <input type="text" placeholder="Type de materiel" name="type" value="<?= !empty($_POST['type']) ?  $_POST['type'] : '' ?>">
        <div class="ertype"></div>
        <label for="type">Référence :  </label>
        <input type="text" placeholder="Référence :" name="ref" value="<?= !empty($_POST['ref']) ?  $_POST['ref'] : '' ?>">
        <div class="erref"></div>
        <label for="type">Description (Zone de texte)  </label>
        <input type="text" placeholder="blablabla" name="desc" value="<?= !empty($_POST['desc']) ?  $_POST['desc'] : '' ?>">
        <div class="erdesc"></div>
    </form>
</div>


<?php
?>