<?php
require '../vendor/autoload.php';

use \setasign\Fpdi\Fpdi;
// Crée une instance de la classe FPDI
$pdf = new Fpdi();

// Charge le PDF existant
$pageCount = $pdf->setSourceFile("../Demande d'accès à la salle VR_V062.pdf");

// Ajoute une nouvelle page
$pdf->AddPage();

// Importe la première page du PDF existant
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, 0, 0);

// Ajoute du texte à la page
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(108, 256);
$pdf->Cell(0, 0, "1", 0, 1);

// Enregistre le PDF modifié
$pdf->Output();
