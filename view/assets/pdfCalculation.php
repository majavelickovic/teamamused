<?PHP
include('FPDF/fpdf.php');   //Pfad zu fpdf.php

/*
$pdf = new FPDF();  
$pdf->AddPage();  

//Titel
$pdf->SetFont('Arial','B',16);
$pdf->SetXY(5,5);
$pdf->Write(0,"Reise: " . $_POST['reise']);
$pdf->Ln();
$pdf->Ln();*/

/*Einstellung der Überschrift */  
/*$pdf->setXY(30,5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetLineWidth(0.2);
$pdf->SetDrawColor(0,0);
$pdf->SetFillColor(192,192);*/

// Überschrift
/*$pdf->Cell(100,10,"Beschreibung","LTR",0,"C",0);
$pdf->Cell(40,10,"Einnahmen/Ausgaben",1,0,"C",0);
$pdf->Cell(100,10,"text2","LTR",0,"C",0);
$pdf->Cell(40,10,"text3",1,0,"C",0);*/

/* Einstellungen der Tabelle */
/*$pdf->SetFont('Arial', '', 10);

// Lese Daten für Schlussabrechnung
/*$pdo = database\Database::connect();           
$statement = $pdo->prepare("SELECT beschreibung FROM reise WHERE reise = :reise;");
$statement->bindValue(':reise', $_POST['reise']);
$statement->execute();
while ($row = $statement->fetch()){
    $reisename = $row['beschreibung'];
}*/
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
class PDF extends FPDF {
  // Kopfzeile
  function Header()
  {
    // Arial fett 15
    $this->SetFont('Arial','B',15);
     // nach rechts gehen
     $this->Cell(80);
     // Titel
     $this->Cell(30,10,'Titel',1,0,'C');
     // Zeilenumbruch
     $this->Ln(20);
  } 

  // Fusszeile
  function Footer()
  {
     // Position 1,5 cm von unten
     $this->SetY(-15);
     // Arial kursiv 8
     $this->SetFont('Arial','I',8);
     // Seitenzahl
     $this->Cell(0,10,'Seite '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
for($i=1;$i<=40;$i++)
  $pdf->Cell(0,10,'Zeilennummer '.$i,0,1);
$pdf->Output();    
?>
