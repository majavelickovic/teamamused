<?php
/**
 * Controller für die Rechnungs-View
 */

namespace controller;

use view\view as View;
use service\Service;

class RechnungController
{

    /*
     * Übernimmt die Angaben aus dem Rechnungsformular und gibt diese an die Service-Klasse weiter
     * Erhält aus der Service-Klasse einen Boolean zurück bei erfolgreichem Ändern/Hinzufügen einer Rechnung
     */
    public static function neueRechnung(){
        return Service::getInstance()->createRechnung(
                $_POST["reise"],
                $_POST["rgart"],
                $_POST["kosten"],
                $_POST["beschreibung"],
                $_POST["dokument"]);
    }
    
        public static function leseRechnung(){
        return Service::getInstance()->readRechnung(
                $_POST["userId"],
                $_POST["userId"], // TODO: why userId and benutzername??? 
                $_POST["passwort"],
                $_POST["vorname"],
                $_POST["nachname"],
                "rolle"); // TODO: delete
    }
    
        public static function aktualisiereRechnung(){
        return Service::getInstance()->updateRechnung(
                $_POST["userId"],
                $_POST["userId"], // TODO: why userId and benutzername??? 
                $_POST["passwort"],
                $_POST["vorname"],
                $_POST["nachname"],
                "rolle"); // TODO: delete
    }
    
        public static function loescheRechnung(){
        return Service::getInstance()->deleteRechnung(
                $_POST["userId"],
                $_POST["userId"], // TODO: why userId and benutzername??? 
                $_POST["passwort"],
                $_POST["vorname"],
                $_POST["nachname"],
                "rolle"); // TODO: delete
    }
    
    public static function rechnungAnzeigeView(){
        echo (new View("exist_calculation.php"))->render();
    }

    public static function rechnungHinzufView(){
        echo (new View("new_calculation.php"))->render();
    }
}
?>