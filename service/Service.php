<?php

namespace service;

use dao;
use domain\Login;
use domain\Rechnung;

/**
 * @access public
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 */


class Service {
    /**
     * Variable, welche das Serice-Objekt beinhaltet
     */
    private static $instance = null;
    
    /**
     * Speichert den Benutzernamen des akutellen Users
     */
    private $currentBenutzername;

    /**
     * Erzeugt ein Service-Objekt
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Konstruktor
     */
    protected function __construct() { }

    /**
     * Gibt einen Boolean zurück, ob der currentBenutzername gesetzt ist oder nicht
     */
    protected function verifyAuth() {
        return isset($this->currentBenutzername);
    }

    /**
     * Prüft, ob es den Benutzernamen gibt und ob das eingegebene Passwort stimmt
     */
    public function verifyUser($benutzername, $password) {
        $loginDAO = new dao\LoginDAO();
        $loginUser = $loginDAO->findByBenutzername($benutzername);
        if (isset($loginUser)) {
            if (password_verify($password, $loginUser->getPasswort())) {
                if (password_needs_rehash($loginUser->getPasswort(), PASSWORD_DEFAULT)) {
                    $loginUser->setPassword(password_hash($password, PASSWORD_DEFAULT));
                    $loginDAO->update($loginUser);
                }
                $this->currentBenutzername = $loginUser->getBenutzername();
                return true;
            }
        }
        return false;
    }

    // CRUD-Methoden für Login
    
    /**
     * Liest den eingeloggten Mitarbeiter aus der Datenbank
     */
    public function readLogin() {
        if($this->verifyAuth()) {
            $loginDAO = new dao\LoginDAO();
            return $loginDAO->read($this->currentBenutzername);
        }
        return null;
    }

    /**
     * Bearbeitet den eingeloggten Mitarbeiter in der Datenbank, falls es diesen bereits gibt, oder erstellt einen neuen Eintrag
     */
    public function editLogin($benutzername, $passwort, $vorname, $nachname, $rolle) {
        $loginUser = new Login();
        $loginUser->setBenutzername($benutzername);
        $loginUser->setVorname($vorname);
        $loginUser->setNachname($nachname);        
        //$loginUser->set($rolle); -> kein Setter vorhanden
        $passwordHash = password_hash($passwort, PASSWORD_DEFAULT);
        $loginUser->setPasswort($passwordHash);
        $loginDAO = new dao\LoginDAO();
        if($this->verifyAuth()) {
            $loginUser->setBenutzername($this->currentBenutzername);
            $loginDAO->update($loginUser);
            return true;
        }else{
            if(!is_null($loginDAO->findByBenutzername($benutzername))){
                return false;
            }
            $loginDAO->create($loginUser);
            return true;
        }
    }
    
    // Überprüft, ob es den übergebenen Benutzernamen bereits gibt
    public function uniqueBenutzername($benutzername){
        $loginDAO = new dao\LoginDAO();
        if ($loginDAO->findBenutzername($benutzername)){
            return true; // Benutzername bereits vorhanden
        }
        else {
            return false; // Benutzername noch nicht vorhanden
        }
            
    }
    
    // CRUD-Methoden für Reisen
    
    /**
     * TODO -> Reise mit Werten aus Formular befüllen
     */
    public function createReise(Reise $reise) {
        if($this->verifyAuth()) {
            $reiseDAO = new dao\ReiseDAO();
            // Reiseinhalte bestimmen
            $reise->setReise_id($aReise_id);
            $reise->setBeschreibung($aBeschreibung);
            $reise->setDatum_start($aDatum_start);
            $reise->setDatum_ende($aDatum_ende);
            $reise->getMax_teilnehmer();
            $reise->setPreis($aPreis);
            return $reiseDAO->create($reise);
        }
        return null;
    }

    /**
     * Liest anhand der Reise-Id die entsprechende Reise aus der Datenbank
     */
    public function readReise($reiseId) {
        if($this->verifyAuth()) {
            $reiseDAO = new dao\ReiseDAO();
            return $reiseDAO->read($reiseId);
        }
        return null;
    }

    /**
     * TODO
     */
    public function updateReise(Reise $reise) {
        if($this->verifyAuth()) {
            $reiseDAO = new dao\ReiseDAO();
            return $reiseDAO->update($reise);
        }
        return null;
    }

    /**
     * Löscht anhand der Reise-ID die entsprechende Reise aus der Datenbank
     */
    public function deleteReise($reiseId) {
        if($this->verifyAuth()) {
            $reiseDAO = new dao\ReiseDAO();
            $reise = new Reise();
            $reise->setReise_id($reiseId);
            $reiseDAO->delete($reise);
        }
    }

    /**
     * TODO -> auch in ReiseDAO anpassen -> je nach Anzahl "find"-Methoden müssen auch hier diese entsprechend implementiert werden
     */
    public function findAllReisen() {
        if($this->verifyAuth()){
            $reiseDAO = new dao\ReiseDAO();
            return $reiseDAO->findByAgent($this->currentBenutzername); // Methode gibt es so nicht in ReiseDAO
        }
        return null;
    }

    // CRUD-Methoden für Teilnehmer
    
    /**
     * TODO -> Teilnehmer mit Werten aus Formular befüllen
     */
    public function createTeilnehmer(Teilnehmer $teilnehmer) {
        if($this->verifyAuth()) {
            $teilnehmerDAO = new \dao\TeilnehmerDAO();
            // Teilnehmerinhalte bestimmen
            $teilnehmer->setTeilnehmer_id($aTeilnehmer_id);         
            $teilnehmer->setVorname($aVorname);
            $teilnehmer->setNachname($aNachname);
            $teilnehmer->setGeburtsdatum($aGeburtsdatum);
            $teilnehmer->setMail($aMail);
            $teilnehmer->setTelefon($aTelefon);
            return $teilnehmerDAO->create($teilnehmer);
        }
        return null;
    }

    /**
     * Liest anhand der Teilnehmer-Id den entsprechenden Teilnehmer aus der Datenbank
     */
    public function readTeilnehmer($teilnehmerId) {
        if($this->verifyAuth()) {
            $teilnehmerDAO = new \dao\TeilnehmerDAO();
            return $teilnehmerDAO->read($teilnehmerId);
        }
        return null;
    }

    /**
     * TODO
     */
    public function updateTeilnehmer(Teilnehmer $teilnehmer) {
        if($this->verifyAuth()) {
            $teilnehmerDAO = new \dao\TeilnehmerDAO();
            return $teilnehmerDAO->update($teilnehmer);
        }
        return null;
    }

    /**
     * Löscht anhand der Teilnehmer-ID den entsprechenden Teilnehmer aus der Datenbank
     */
    public function deleteTeilnehmer($teilnehmerId) {
        if($this->verifyAuth()) {
            $teilnehmerDAO = new \dao\TeilnehmerDAO();
            $teilnehmer = new Teilnehmer();
            $teilnehmer->setTeilnehmer_id($teilnehmerId);
            $teilnehmerDAO->delete($teilnehmer);
        }
    }

    /**
     * TODO -> auch in TeilnehmerDAO anpassen -> je nach Anzahl "find"-Methoden müssen auch hier diese entsprechend implementiert werden
     */
    public function findAllTeilnehmer() {
        if($this->verifyAuth()){
            $teilnehmerDAO = new \dao\TeilnehmerDAO();
            return $teilnehmerDAO->findByAgent($this->currentBenutzername); // Methode gibt es so nicht in TeilnehmerDAO
        }
        return null;
    }
    
    // CRUD-Methoden für Rechnungen
    
    /**
     * TODO -> Rechnung mit Werten aus Formular befüllen
     */
    public function createInvoice($reise, $rgart, $kosten, $beschreibung, $dokument) {
        $rechnungDAO = new \dao\RechnungDAO();
        // Rechnungsinhalte bestimmen
        $neu_id = $rechnungDAO->getNewRgID(); 
        $rechnung = new Rechnung();
        $rechnung->setRg_id($neu_id); // hole neue Rechnungs-ID
        $rechnung->setReise($reise);
        $rechnung->setRechnungsart($rgart);       
        $rechnung->setBeschreibung($beschreibung);
        $rechnung->setKosten($kosten);
        $rechnung->setDokument($dokument);
        $rechnungDAO->create($rechnung);
        return $rechnung;
    }

    /**
     * Liest anhand der Rechnungs-Id die entsprechende Rechnung aus der Datenbank
     */
    public function readInvoice($reise, $rg_id, $rgart) {
        //if($this->verifyAuth()) {
            $rechnungDAO = new \dao\RechnungDAO();
            return $rechnungDAO->read($reise, $rg_id, $rgart);
        //}
    }
    
        /**
     * Liest anhand der Rechnungs-Id die entsprechende Rechnung aus der Datenbank
     */
    public function readFinalBIlling($reise) {
        //if($this->verifyAuth()) {
            $rechnungDAO = new \dao\RechnungDAO();
            return $rechnungDAO->readFinalBilling($reise);
        //}
    }

    /**
     * TODO
     */
    public function updateInvoice($rg_id, $reise, $rgart, $kosten, $beschreibung, $dokument) {
        //if($this->verifyAuth()) {
            $rechnungDAO = new \dao\RechnungDAO();
            return $rechnungDAO->update($rg_id, $reise, $rgart, $kosten, $beschreibung, $dokument);
        //}
        return null;
    }

    /**
     * Löscht anhand der Rechnungs-ID die entsprechende Rechnung aus der Datenbank
     */
    public function deleteInvoice($rechnungId) {
        //if($this->verifyAuth()) {
            $rechnungDAO = new \dao\RechnungDAO();
            $rechnungDAO->delete($rechnungId);
        //}
    }

    /**
     * TODO -> auch in RechnungDAO anpassen -> je nach Anzahl "find"-Methoden müssen auch hier diese entsprechend implementiert werden
     */
    public function findAllInvoice() {
        if($this->verifyAuth()){
            $rechnungDAO = new \dao\RechnungDAO();
            return $rechnungDAO->findByAgent($this->currentBenutzername); // Methode gibt es so nicht in RechnungDAO
        }
        return null;
    }
    
    /**
     * ????
     */
//    public function validateToken($token, $type = self::AGENT_TOKEN) {
//        switch ($type){
//            case self::AGENT_TOKEN :
//                $tokenArray = explode(":", $token);
//                if(count($tokenArray)>1) {
//                    $this->currentAgentId = $tokenArray[0];
//                    return true;
//                }
//                break;
//            case self::RESET_TOKEN :
//                break;
//            case self::JWT_TOKEN :
//                break;
//        }
//        return false;
//    }

    /**
     * ???
     */
//    public function issueToken($type = self::AGENT_TOKEN) {
//        switch ($type){
//            case self::AGENT_TOKEN :
//                return $this->currentAgentId .":". bin2hex(random_bytes(20));
//            case self::RESET_TOKEN :
//                break;
//            case self::JWT_TOKEN :
//                break;
//        }
//        return null;
//    }
}