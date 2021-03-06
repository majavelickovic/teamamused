<?php
/**
 * Controller für die PDF-Erstellung
 */

namespace controller;

use view\view as View;

class PDFController
{

    public static function pdfCalculationView() {
        echo (new View("assets/pdfCalculation.php"))->render();
    }
    
    public static function showSingleCalcPDF() {
        echo (new View("assets/viewAttachedCalculationPDF.php"))->render();
    }
}
?>