<?php
// reference the Dompdf namespace
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->setIsRemoteEnabled(true);
$dompdf = new Dompdf($options);


// instantiate and use the dompdf class

ob_start();

include "pdf/reservation.php";
$html = ob_get_contents();

ob_end_clean();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4');

// Render the HTML as PDF
$dompdf->render();
$dompdf->stream();
// Output the generated PDF to Browser
