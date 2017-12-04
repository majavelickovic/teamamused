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
                $_POST["reisetitel"],
                $_POST["beschreibung"],
                $_POST["datum_start"],
                $_POST["datum_ende"],
                $_POST["preis"],
                $_POST["reiseleiter"],
                $_POST["standort"]);
    }
    
        public static function leseReise(){
        return Service::getInstance()->readReise(
                $_POST["reise_id"],
                $_POST["reisetitel"],
                $_POST["reiseleiter"],
                $_POST["datum_start"],
                $_POST["datum_ende"],
                $_POST["preis"],
                $_POST["standort"]);
    }
    
        public static function aktualisiereReise(){
        return Service::getInstance()->updateReise(
                $_POST["reisetitel"],
                $_POST["beschreibung"],
                $_POST["reiseleiter"],
                $_POST["datum_start"],
                $_POST["datum_ende"],
                $_POST["preis"],                
                $_POST["standort"]);
    }
    
        public static function loescheReise(){
        return Service::getInstance()->deleteReise(
                $_POST["reise_id"],
                $_POST["reisetitel"]);
    }
    
    public static function reiseAnzeigeView(){
        echo (new View("exist_journey.php"))->render();
    }

    public static function reiseHinzufView(){
        echo (new View("new_journey.php"))->render();
    }
}
