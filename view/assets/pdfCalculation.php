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
  
  // Simple table
  function BasicTable($header,$data)
  {
    // Header
    foreach($header as $col)
     $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
     foreach($row as $col)
     $this->Cell(40,6,$col,1);
     $this->Ln();
    }
  }

  // Better table
  function ImprovedTable($header,$data)
  {
    // Column widths
    $w=array(40,35,40,45);
    // Header
    for($i=0;$i<count($header);$i++)
     $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
     $this->Cell($w[0],6,$row[0],'LR');
     $this->Cell($w[1],6,$row[1],'LR');
     $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
     $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
     $this->Ln();
    }
    // Closure line
    $this->Cell(array_sum($w),0,'','T');
  }

  // Colored table
  function FancyTable($header,$data)
  {
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w=array(40,35,40,45);
    for($i=0;$i<count($header);$i++)
     $this->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill=0;
    foreach($data as $row)
    {
     $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
     $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
     $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
     $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
     $this->Ln();
     $fill=!$fill;
    }
    $this->Cell(array_sum($w),0,'','T');
  }
  
}

$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$dataSchlussabrechnung = controller\RechnungController::readFinalBilling($_POST['reise']);
$pdf->BasicTable($header,$dataSchlussabrechnung);
$pdf->AddPage();
$pdf->ImprovedTable($header,$dataSchlussabrechnung);
$pdf->AddPage();
$pdf->FancyTable($header,$dataSchlussabrechnung);
$pdf->Output();    
?>
