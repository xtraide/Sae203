<?php
$id = 165;
// reference the Dompdf namespace
require 'link/linkPdo.php';
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->setIsRemoteEnabled(true);
$dompdf = new Dompdf($options);

$result = execute("SELECT utilisateur.email, utilisateur.nom AS usernom, utilisateur.prenom AS userprenom, utilisateur.date, reservation.horraire_debut, reservation.horraire_fin FROM utilisateur, reservation WHERE reservation.id_utilisateur = utilisateur.id AND reservation.id_materiel = 165;", [
    'id' => $id
]);
$result2 = execute("SELECT materiel.nom AS materiel_nom, materiel.id, materiel.reference, quantite.quantite FROM materiel, quantite WHERE quantite.id_materiel = materiel.id");
// instantiate and use the dompdf class
if ($result->rowCount() > 0) {
    while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
        while ($row2 = $result2->fetchAll(PDO::FETCH_ASSOC)) {
            ob_start();

            include "pdf/reservation.php";
            $html = ob_get_contents();

            ob_end_clean();
        }
    }
}
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4');

// Render the HTML as PDF
$dompdf->render();
$dompdf->stream();
// Output the generated PDF to Browser
