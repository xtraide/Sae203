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
        <label for="type">Référence : </label>
        <input type="text" placeholder="Référence :" name="ref" value="<?= !empty($_POST['ref']) ?  $_POST['ref'] : '' ?>">
        <div class="erref"></div>
        <label for="type">Description (Zone de texte) </label>
        <input type="text" placeholder="blablabla" name="desc" value="<?= !empty($_POST['desc']) ?  $_POST['desc'] : '' ?>">
        <div class="erdesc"></div>
        <button type="submit" name="Ajouter" value="1">Ajouter un materiel</button>
    </form>
</div>

<?php
include $path . "function.php";
if (!empty($_POST['Ajouter'])) {
    $nom = isvalid('nom');
    $type = isvalid('type');
    $ref = isvalid('ref');
    $desc = isvalid('desc');
    if (!empty($nom) && !empty($type) && !empty($ref) && !empty($desc)) {
        execute("INSERT INTO `materiel`( `nom`, `type`, `reference`, `description`) VALUES ('{$nom}','{$type}','{$ref}','{$desc}');");
        echo 'DAME';
    }
}


?>