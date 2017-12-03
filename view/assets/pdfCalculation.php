<?PHP
include('FPDF/fpdf.php');   //Pfad zu fpdf.php

$pdf = new FPDF();  // neues Objekt der Klasse FPDF
$pdf->AddPage();    // erzeugt eine Seite
$pdf->SetFont('Arial', 'B', 16);   
$pdf->Cell(40,10,'Schlussrechnung');
$pdf->Output();     // Ausgabe des PDF-Objekts
?>
