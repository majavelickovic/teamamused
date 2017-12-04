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
    public static function newJourney(){
        return Service::getInstance()->createJourney(
                $_POST["reisetitel"],
                $_POST["beschreibung"],
                $_POST["datum_start"],
                $_POST["datum_ende"],
                $_POST["preis"],
                $_POST["reiseleiter"],
                $_POST["startort"]);
    }
    
        public static function readJourney(){
        return Service::getInstance()->readJourney(
                $_POST["reise_id"],
                $_POST["reisetitel"],
                $_POST["reiseleiter"],
                $_POST["datum_start"],
                $_POST["datum_ende"],
                $_POST["preis"],
                $_POST["startort"]);
    }
    
        public static function updateJourney(){
        return Service::getInstance()->updateJourney(
                $_POST["reisetitel"],
                $_POST["beschreibung"],
                $_POST["reiseleiter"],
                $_POST["datum_start"],
                $_POST["datum_ende"],
                $_POST["preis"],                
                $_POST["startort"]);
    }
    
        public static function deleteJourney(){
        return Service::getInstance()->deleteReise(
                $_POST["reise_id"],
                $_POST["reisetitel"]);
    }
    
    public static function readJourneyName($reise){
        return Service::getInstance()->readReiseName(
                $reise);
    }
    
    public static function journeyShowView(){
        echo (new View("exist_journey.php"))->render();
    }

    public static function jouneyAddView(){
        echo (new View("new_journey.php"))->render();
    }
}
