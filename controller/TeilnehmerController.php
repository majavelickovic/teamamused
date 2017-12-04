<?php
/**
 * Controller für die Teilnehmer-View
 */

namespace controller;

use view\view as View;
use service\Service;

class TeilnehmerController
{

    /*
     * Übernimmt die Angaben aus dem Teilnehmerformular und gibt diese an die Service-Klasse weiter
     * Erhält aus der Service-Klasse einen Boolean zurück bei erfolgreichem Ändern/Hinzufügen eines Teilnehmers
     */
    public static function neuerTeilnehmer(){
        return Service::getInstance()->createTeilnehmer(
                $_POST["reise_id"],
                $_POST["reisetitel"],
                $_POST["vorname"],
                $_POST["nachname"],
                $_POST["geburtsdatum"]);
    }
    
        public static function leseTeilnehmer(){
        return Service::getInstance()->readTeilnehmer(
                $_POST["reise_id"],
                $_POST["reisetitel"],
                $_POST["teilnehmer_id"],
                $_POST["vorname"],
                $_POST["nachname"],
                $_POST["geburtsdatum"]);
    }
    
        public static function aktualisiereTeilnehmer(){
        return Service::getInstance()->updateTeilnehmer(
                $_POST["reise_id"],
                $_POST["reisetitel"],
                $_POST["teilnehmer_id"],
                $_POST["vorname"],
                $_POST["nachname"],
                $_POST["geburtsdatum"]);
    }
    
        public static function loescheTeilnehmer(){
        return Service::getInstance()->deleteTeilnehmer(
                $_POST["teilnehmer_id"],
                $_POST["vorname"],
                $_POST["nachname"]);
    }
    
    public static function teilnehmerAnzeigeView(){
        echo (new View("exist_participant.php"))->render();
    }

    public static function teilnehmerHinzufView(){
        echo (new View("new_participant.php"))->render();
    }
}