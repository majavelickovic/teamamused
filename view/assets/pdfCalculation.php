<?PHP
include('FPDF/fpdf.php');   //Pfad zu fpdf.php

$pdf = new FPDF();  
$pdf->AddPage();  

/*Einstellung der Überschrift */  
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetLineWidth(0.2);
$pdf->SetDrawColor(0,0);
$pdf->SetFillColor(192,192);

// Überschrift
$pdf->Cell(120,5,"Beschreibung","LTR",0,"C",1);
$pdf->Cell(30,5,"Einnahmen/Ausgaben","1",0,"C",1);
$pdf->Ln();

/* Einstellungen der Tabelle */
$pdf->SetFont('Arial', '', 10);
$zinsfuss = 1.5;

// Lese Daten für Schlussabrechnung
$pdo = database\Database::connect();           
$statement = $pdo->prepare("SELECT beschreibung FROM reise WHERE reise = :reise;");
$statement->bindValue(':reise', $_POST['reise']);
$statement->execute();
while ($row = $statement->fetch()){
    $reisename = $row['beschreibung'];
}
/*$dataSchlussabrechnung = controller\RechnungController::readFinalBilling($_POST['reise']);
$pdf->SetTitle($reisename);
// Tabelle

for ($rows=0; array_count_values($dataSchlussabrechnung)-1; $rows=$row+1)
{*/
/* Einstellung für unterschiedliche Zeilenfarbe */
   /* if ($rows%2==0)
    {
	$pdf->SetFillColor(192,192);
    }else{
	$pdf->SetFillColor(224,224);
    }

$pdf->Cell(120,5,array_column($dataSchlussabrechnung($rows,0)),"LR",0,"C",1);
$pdf->Cell(30,5,"CHF ".number_format(array_columns($dataSchlussabrechnung($rows,1)), 1),"LR",0,"R",1);
$pdf->Ln();
}*/

$pdf->Output();     
?>
