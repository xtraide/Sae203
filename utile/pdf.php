<?php
$path =   "../utile/";
use Dompdf\Dompdf;
require_once $path . 'dompdf/autoload.inc.php';
$pdf = new Dompdf();

$pdf->loadHtml("fff");
$pdf->setPaper('A4','portrait');
$pdf->render();

//$pdf->stream(); 
