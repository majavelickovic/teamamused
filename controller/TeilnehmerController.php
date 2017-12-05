<?php
/**
 * Controller für die Teilnehmer-View
 */

namespace controller;

use view\view as View;
use service\Service;

$del_teilnehmer_id = $_GET['del_teilnehmer_id'];
if($del_teilnehmer_id > 0){
    TeilnehmerController::deleteParticipant($del_teilnehmer_id);
}

class TeilnehmerController
{

    /*
     * Übernimmt die Angaben aus dem Teilnehmerformular und gibt diese an die Service-Klasse weiter
     * Erhält aus der Service-Klasse einen Boolean zurück bei erfolgreichem Ändern/Hinzufügen eines Teilnehmers
     */
    public static function newParticipant(){
        return Service::getInstance()->createParticipant(
                $_POST["reise_id"],
                $_POST["reisetitel"],
                $_POST["vorname"],
                $_POST["nachname"],
                $_POST["geburtsdatum"]);
    }
    
        public static function readParticipant(){
        return Service::getInstance()->readParticipant(
                $_POST["reise_id"],
                $_POST["reisetitel"],
                $_POST["teilnehmer_id"],
                $_POST["vorname"],
                $_POST["nachname"],
                $_POST["geburtsdatum"]);
    }
    
        public static function updateParticipant(){
        return Service::getInstance()->updateParticipant(
                $_POST["reise_id"],
                $_POST["reisetitel"],
                $_POST["teilnehmer_id"],
                $_POST["vorname"],
                $_POST["nachname"],
                $_POST["geburtsdatum"]);
    }
    
        public static function deleteParticipant(){
        return Service::getInstance()->deleteParticipant(
                $_POST["teilnehmer_id"],
                $_POST["vorname"],
                $_POST["nachname"]);
    }
    
    public static function participantShowView(){
        echo (new View("exist_participant.php"))->render();
    }

    public static function participantAddView(){
        echo (new View("new_participant.php"))->render();
    }
}