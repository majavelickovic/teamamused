<?php
/**
 * Controller für die Teilnehmer-View
 * @author Sandra Bodack
 */

namespace controller;

use view\view as View;
use service\Service;

class TeilnehmerController {
    /*
     * Übernimmt die Angaben aus dem Teilnehmerformular und gibt diese an die Service-Klasse weiter
     * Erhält aus der Service-Klasse einen Boolean zurück bei erfolgreichem Ändern/Hinzufügen eines Teilnehmers
     */

    public static function newParticipant() {
        return Service::getInstance()->createParticipant(
                        $_POST["reise"], $_POST["vorname"], $_POST["nachname"], $_POST["geburtsdatum"]);
    }

    public static function readParticipant() {
        return Service::getInstance()->readParticipant(
                        $_POST["reise"], $_POST["teilnehmer_id"], $_POST["vorname"], $_POST["nachname"]);
    }

    public static function readSingleParticipant() {
        return Service::getInstance()->readSingleParticipant(
                        $_POST["teilnehmer_id"]);
    }
    
    public static function updateParticipant() {
        return Service::getInstance()->updateParticipant(
                        $_POST["teilnehmer_id"], $_POST["reise"], $_POST["vorname"], $_POST["nachname"], $_POST["geburtsdatum"]);
    }

    public static function deleteParticipant($teilnehmer_id) {
        return Service::getInstance()->deleteParticipant(
                        $teilnehmer_id);
    }

    public static function participantShowView() {
        echo (new View("exist_participant.php"))->render();
    }

    public static function participantAddView() {
        echo (new View("new_participant.php"))->render();
    }

    public static function participantShowSingleView() {
        echo (new View("single_participant.php"))->render();
    }

    public static function participantChoiceView() {
        echo (new View("participant.php"))->render();
    }

}
