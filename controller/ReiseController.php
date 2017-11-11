<?php
/**
 * Controller für die Reise-View
 */

namespace controller;

use view\view as View;
use service\Service;

class ReiseController
{

    /*
     * Übernimmt die Angaben aus dem Reiseformular und gibt diese an die Service-Klasse weiter
     * Erhält aus der Service-Klasse einen Boolean zurück bei erfolgreichem Ändern/Hinzufügen einer Reise
     */
    public static function neueReise(){
        return Service::getInstance()->createReise(
                $_POST["reise"],
                $_POST["rgart"],
                $_POST["kosten"],
                $_POST["beschreibung"],
                $_POST["dokument"]);
    }
    
        public static function leseReise(){
        return Service::getInstance()->readReise(
                $_POST["reise"],
                $_POST["rg_id"],
                $_POST["rgart"]);
    }
    
        public static function aktualisiereReise(){
        return Service::getInstance()->updateReise(
                $_POST["reise"],
                $_POST["rgart"],
                $_POST["kosten"],
                $_POST["beschreibung"],
                $_POST["dokument"]);
    }
    
        public static function loescheReise(){
        return Service::getInstance()->deleteRechnung(
                $_POST["rg_id"],
                $_POST["reise"]);
    }
    
    public static function reiseAnzeigeView(){
        echo (new View("exist_journey.php"))->render();
    }

    public static function reiseHinzufView(){
        echo (new View("new_journey.php"))->render();
    }
}
?>