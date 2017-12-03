<?PHP
include('FPDF/fpdf.php');   //Pfad zu fpdf.php

class PDF extends FPDF {
  // Kopfzeile
  function Header()
  {
    // Lese Reisetitel
    $pdo = database\Database::connect();           
    $statement = $pdo->prepare("SELECT beschreibung FROM reise WHERE reise_id = :reise;");
    $statement->bindValue(':reise', $_POST['reise']);
    $statement->execute();
    while ($row = $statement->fetch()){
        $reisename = $row['beschreibung'];
    }
    // Arial fett 15
    $this->SetFont('Arial','B',15);
     // nach rechts gehen
     $this->Cell(80);
     // Titel
     $this->Cell(200,10,'Schlussabrechnung - ' . $reisename,1,0,'L');
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
  

  // Colored table
  function showTableContent($header,$data)
  {
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $this->Cell(150,7,'Beschreibung',1,0,'C',1);
    $this->Cell(50,7,'Einnahmen/Ausgaben',1,0,'C',1);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill=0;
    foreach($data as $row)
    {
     $this->Cell(150,6,$row[0],'LR',0,'L',$fill);
     $this->Cell(50,6,'CHF ' . number_format($row[1],2),'LR',0,'R',$fill);
     $this->Ln();
     $fill=!$fill;
    }
    $this->Cell(array_sum($w),0,'','T');
  }
  
}

$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->SetFont('Arial','',14);
$dataSchlussabrechnung = controller\RechnungController::readFinalBilling($_POST['reise']);
$pdf->showTableContent($header,$dataSchlussabrechnung);
$pdf->Output();    
?>
