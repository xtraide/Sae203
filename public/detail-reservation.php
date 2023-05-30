<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = execute("SELECT utilisateur.nom AS usernom, utilisateur.prenom AS userprenom,  reservation.id as resid ,reservation.horraire_debut,reservation.horraire_fin, reservation.date, reservation.statut, materiel.type, materiel.nom AS materielnom ,materiel.reference,materiel.description  FROM `reservation`, `materiel`, `utilisateur` WHERE reservation.id_utilisateur = utilisateur.id AND reservation.id_materiel = materiel.id AND reservation.id = :id", [
        'id' => $id
    ]);
    if ($result->rowCount() > 0) {
        while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($row as $row) {
?>
                <div class="itemcard">
                    <p>id : <?= $row['resid']; ?></p>
                    <p>prenom du demandeur :<br><br> <?= $row['userprenom']; ?></p>
                    <p>nom du demandeur : <br><br><?= $row['usernom']; ?></p>
                    <p>date :<br><br> <?= $row['date']; ?> </p>
                    <p>plage horraire :<br><br> <?= $row['horraire_debut'] . " - " . $row['horraire_fin']; ?> </p>
                    <p>materiel :
                        <li>nom : <?= $row['userprenom']; ?></li>
                        <li>Type : <?= $row['type']; ?></li>
                        <li>Refference : <?= $row['reference']; ?> </li>
                        <li>description : <?= $row['description']; ?></li>
                    </p>
                </div>
                <form action="../utile/pdf/getpdf.php?id=<?= $_GET['id']; ?>" method="post">
                    <button type="submit" value="AAA" name="pdf" id="pdf" class="admin">Télécharger le PDF</button>
                </form>
<?php
            }
        }
    } else {

        echo "No results found.";
    }
}

include $path . "html/footer.php";
?>