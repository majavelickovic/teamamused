<?php
/**
 * Controller für die Reise-View
 */

namespace controller;

use view\view as View;
use service\Service;

class ReiseController {
    /*
     * Übernimmt die Angaben aus dem Reiseformular und gibt diese an die Service-Klasse weiter
     * Erhält aus der Service-Klasse einen Boolean zurück bei erfolgreichem Ändern/Hinzufügen einer Reise
     */
    public static function newJourney() {
        return Service::getInstance()->createJourney(
                        $_POST["titel"], $_POST["beschreibung"], $_POST["datum_start"], $_POST["datum_ende"], $_POST["preis"], $_POST["reiseleiter"], $_POST["startort"]);
    }

    public static function readJourney() {
        return Service::getInstance()->readJourney(
                        $_POST["reise_id"], $_POST["titel"], $_POST["reiseleiter"], $_POST["datum_start"], $_POST["datum_ende"], $_POST["preis"], $_POST["startort"]);
    }

    public static function updateJourney() {
        return Service::getInstance()->updateJourney(
                        $_POST["reise_id"], $_POST["titel"], $_POST["beschreibung"], $_POST["reiseleiter"], $_POST["datum_start"], $_POST["datum_ende"], $_POST["preis"], $_POST["startort"]);
    }

    public static function deleteJourney($reise_id) {
        return Service::getInstance()->deleteJourney(
                        $reise_id);
    }

    public static function readJourneyName($reise) {
        return Service::getInstance()->readJourneyName(
                        $reise);
    }

    public static function journeyShowView() {
        echo (new View("exist_journey.php"))->render();
    }

    public static function jouneyAddView() {
        echo (new View("new_journey.php"))->render();
    }

    public static function journeyChoiceView() {
        echo (new View("journey.php"))->render();
    }
    
}
