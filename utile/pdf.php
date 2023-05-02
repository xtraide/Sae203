<?php
require '../vendor/autoload.php';

use \setasign\Fpdi\Fpdi;
// Crée une instance de la classe FPDI
$pdf = new Fpdi();

// Charge le PDF existant
$pageCount = $pdf->setSourceFile("../Demande d'accès à la salle VR_V06.pdf");

// Ajoute une nouvelle page
$pdf->AddPage();

// Importe la première page du PDF existant
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, 0, 0);

// Ajoute du texte à la page
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(50, 50);
$pdf->Cell(0, 10, 'Texte ajouté à la page', 0, 1);

// Enregistre le PDF modifié
$pdf->Output();
