<?php
/**
 * Controller für die PDF-Erstellung
 */

namespace controller;

use view\view as View;

class PDFController
{

    public static function pdfCalculationView($reise) {
        echo (new View("assets/pdfCalculation.php?reise=".$reise))->render();
    }
}
?>