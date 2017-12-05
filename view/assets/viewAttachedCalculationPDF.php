<?php

/**
 * Zeigt das PDF an, welches einer Rechnung angehängt wurde beim erstellen oder aktualisieren einer Rechnung
 * @author Maja Velickovic
 */

$file = service\Service::getInstance()->getAttachedPDFInvoice($_GET['rg_id']);
/*header('Content-type: application/pdf');
echo file_get_contents('data:application/pdf;base64,'.base64_encode($file));*/

include('FPDF/fpdf.php');   //Pfad zu fpdf.php

$pdf = new PDF();
$pdf->LoadData($file);
$pdf->Output();