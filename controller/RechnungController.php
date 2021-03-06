<?php
/**
 * Controller für die Rechnungs-View
 * @author Maja Velickovic
 */

namespace controller;

use view\view as View;
use service\Service;

class RechnungController {
    /*
     * Übernimmt die Angaben aus dem Rechnungsformular und gibt diese an die Service-Klasse weiter
     * Erhält aus der Service-Klasse einen Boolean zurück bei erfolgreichem Ändern/Hinzufügen einer Rechnung
     */
    public static function newInvoice(){
        if($_FILES["dokument"]["name"] == ""){
            $filename = null;
            $filecontent = null;
        }else{
            $filename = $_FILES["dokument"]["name"];
            $filecontent = file_get_contents($_FILES["dokument"]["tmp_name"]);
        }
        return Service::getInstance()->createInvoice(
                $_POST["reise"],
                $_POST["rgart"],
                $_POST["kosten"],
                $_POST["beschreibung"],
                $filename,
                $filecontent);
    }
    
    public static function readInvoice(){
        return Service::getInstance()->readInvoice(
                $_POST["reise"],
                $_POST["rg_id"],
                $_POST["rgart"]);
    }
    
    public static function updateInvoice(){
        return Service::getInstance()->updateInvoice(
                $_POST["rg_id"],
                $_POST["reise"],
                $_POST["rgart"],
                $_POST["kosten"],
                $_POST["beschreibung"],
                $_FILES["dokument"]["name"],
                file_get_contents($_FILES["dokument"]["tmp_name"]));
    }
    
    public static function deleteInvoice($rg_id){
        return Service::getInstance()->deleteInvoice(
                $rg_id);
    }
    
    public static function readFinalBilling($reise){
        return Service::getInstance()->readFinalBilling(
                $reise);
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
    
    public static function invoiceChoiceView(){
        echo (new View("calculation.php"))->render();
    }
    
    public static function finalBillingView(){
        echo (new View("final_billing.php"))->render();
    }
}

?>