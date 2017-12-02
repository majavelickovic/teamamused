<?php
/**
 * Controller für die Rechnungs-View
 */

namespace controller;

use view\view as View;
use service\Service;

$del_rg_id = $_GET['del_rg_id'];
if($del_rg_id > 0){
    $rgCon = new RechnungController();
    $rgCon->deleteInvoice($del_rg_id);
}

class RechnungController
{

    /*
     * Übernimmt die Angaben aus dem Rechnungsformular und gibt diese an die Service-Klasse weiter
     * Erhält aus der Service-Klasse einen Boolean zurück bei erfolgreichem Ändern/Hinzufügen einer Rechnung
     */
    public static function newInvoice(){
        return Service::getInstance()->createInvoice(
                $_POST["reise"],
                $_POST["rgart"],
                $_POST["kosten"],
                $_POST["beschreibung"],
                $_POST["dokument"]);
    }
    
    public static function readInvoice(){
        return Service::getInstance()->readInvoice(
                $_POST["reise"],
                $_POST["rg_id"],
                $_POST["rgart"]);
    }
    
    public static function updateInvoice(){
        return Service::getInstance()->updateInvoice(
                $_POST["reise"],
                $_POST["rgart"],
                $_POST["kosten"],
                $_POST["beschreibung"],
                $_POST["dokument"]);
    }
    
    public static function deleteInvoice($rg_id){
        return Service::getInstance()->deleteInvoice(
                $rg_Id);
    }
    
    public static function invoiceShowView(){
        echo (new View("exist_calculation.php"))->render();
    }

    public static function invoiceAddView(){
        echo (new View("new_calculation.php"))->render();
    }
    
    public static function invoiceShowSingleView(){
        echo (new View("single_calculation.php"))->render();
    }
}

?>