<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php";
include $path . "pdf.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = execute("SELECT utilisateur.nom AS usernom, utilisateur.prenom AS userprenom,  reservation.id as resid ,reservation.horraire_debut,reservation.horraire_fin, reservation.date, reservation.statut,materiel.id as matid, materiel.type, materiel.nom AS materielnom ,materiel.reference,materiel.description  FROM `reservation`, `materiel`, `utilisateur` WHERE reservation.id_utilisateur = utilisateur.id AND reservation.id_materiel = materiel.id AND reservation.id = :id", [
        'id' => $id
    ]);
    if ($result->rowCount() > 0) {
        while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($row as $row) {
?>
                <div class="itemcard">
                    <p>id : <?= $row['resid']; ?></p>
                    <p>prenom du demandeur : <?= $row['userprenom']; ?></p>
                    <p>nom du demandeur : <?= $row['usernom']; ?></p>
                    <p>date : <?= $row['date']; ?> </p>
                    <p>plage horraire : <?= $row['horraire_debut'] . " - " . $row['horraire_fin']; ?> </p>
                    <p>materiel :
                        <li>nom : <?= $row['userprenom']; ?></li>
                        <li>Type : <?= $row['type']; ?></li>
                        <li>Refference : <?= $row['reference']; ?> </li>
                        <li>description : <?= $row['description']; ?></li>
                    </p>
                </div>
                <button type="submit" onclick="<?php pdf($row['matid']); ?>"></button>
<?php
            }
        }
    } else {

        echo "No results found.";
    }
}

include $path . "html/footer.php";
?>