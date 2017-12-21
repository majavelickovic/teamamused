<?php

/**
 * Erstellt ein PDF, um die Schlussabrechnung in tabellarischer Form anzuzeigen
 * @author Maja Velickovic, Michelle Widmer
 */

include('FPDF/fpdf.php');   //Pfad zu fpdf.php

class PDF extends FPDF {
  // Kopfzeile
  function Header()
  {
    // Lese Reisetitel
    $reisename = controller\ReiseController::readJourneyName($_POST['reise']);
    // Arial fett 15
    $this->SetFont('Arial','B',15);
     // nach rechts gehen
     $this->Cell(5);
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
    $this->Cell(170,7,'Beschreibung',1,0,'C',1);
    $this->Cell(70,7,'Einnahmen/Ausgaben',1,0,'C',1);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill=0;
    $totalsum = 0;
    
    $count = count($data);
    foreach($data as $row)
    {
     $this->Cell(170,6,$row[0],'LR',0,'L',$fill); // Zelle der ersten Spalte
     $this->Cell(70,6,'CHF ' . number_format($row[1],2),'LR',0,'R',$fill); // Zelle der zweiten Spalte
     $totalsum = $totalsum + $row[1]; // summiert den Betrag zum Total
     $this->Ln();
     $fill=!$fill;
     $count = $count-2;
     if($count == 0){
        $this->Cell(170,6,'Total Gewinn/Verlust',1,0,'R',$fill);
        $this->Cell(70,6,'CHF ' . number_format($totalsum,2),1,0,'R',$fill);
     }
     
    }
    
    
//    //Versuch andere Schleife
//    $count = count($data);
//    for ($i=0; $i<$count; $i++) {
//        $this->Cell(170,6,$data[$i],'LR',0,'L',$fill);
//        $this->Cell(70,6,'CHF ' . number_format($data[i+1],2),'LR',0,'R',$fill);
//        $totalsum = $totalsum + $data[i+1];
//        $i = $i+1;
//        $this->Ln();
//        $fill=!$fill;
//    }
    
    
    $this->SetFillColor(0,0,255);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    
    function setLastRow(){
        
    }
        
     
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
