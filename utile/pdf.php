<?php


use Dompdf\Dompdf;

require '../vendor/autoload.php';
function pdf($text, $s = false)
{
    switch ($text) {
        case 'reservation':
            $switch = 'reservation';
            break;
        default;
    }

    $pdf = new Dompdf();
    ob_start();
    //require 'pdf/'.$switch.'.php';
    $html = ob_get_contents();
    ob_end_clean();
    $pdf->loadHtml("html");
    $pdf->setPaper('A4', 'portrait');
    $pdf->render();
    if ($s) {
        $pdf = $pdf->output();
        return $pdf;
    } else {
        $pdf->stream($switch . ".pdf");
    }
}
