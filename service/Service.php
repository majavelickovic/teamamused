<?php

namespace service;

use dao;
use domain\Login;
use domain\Reise;
use domain\Rechnung;
use domain\Teilnehmer;

/**
 * @access public
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Die Klasse ermöglicht den zentralen Zugriff auf die verschiedenen DAO's
 * 
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
    protected function __construct() {
        
    }

    /**
     * Gibt einen Boolean zurück, ob der currentBenutzername gesetzt ist oder nicht
     */
    protected function verifyAuth() {
        return isset($this->currentBenutzername);
    }

    /**
     * Prüft über die LoginDAO, ob es den Benutzernamen gibt und ob das eingegebene Passwort stimmt
     * @author Michelle Widmer
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
     * @author Michelle Widmer
     */
    public function readLogin() {
        if ($this->verifyAuth()) {
            $loginDAO = new dao\LoginDAO();
            return $loginDAO->read($this->currentBenutzername);
        }
        return null;
    }

    /**
     * Bearbeitet den eingeloggten Mitarbeiter in der Datenbank, falls es diesen bereits gibt, oder erstellt einen neuen Eintrag
     * @author Michelle Widmer
     */
    public function editLogin($benutzername, $passwort, $vorname, $nachname) {
        $loginUser = new Login();
        $loginUser->setBenutzername($benutzername);
        $loginUser->setVorname($vorname);
        $loginUser->setNachname($nachname);
        $passwordHash = password_hash($passwort, PASSWORD_DEFAULT);
        $loginUser->setPasswort($passwordHash);
        $loginDAO = new dao\LoginDAO();
        if ($this->verifyAuth()) {
            $loginUser->setBenutzername($this->currentBenutzername);
            $loginDAO->update($loginUser);
            return true;
        } else {
            if (!is_null($loginDAO->findByBenutzername($benutzername))) {
                return false;
            }
            $loginDAO->create($loginUser);
            return true;
        }
    }

    /*
     * Überprüft, ob es den übergebenen Benutzernamen bereits gibt
     * @author Michelle Widmer
     */

    public function uniqueBenutzername($benutzername) {
        $loginDAO = new dao\LoginDAO();
        if ($loginDAO->findBenutzername($benutzername)) {
            return true; // Benutzername bereits vorhanden
        } else {
            return false; // Benutzername noch nicht vorhanden
        }
    }

    // CRUD-Methoden für Reisen

    /**
     * Erstellt eine neue Reise anhand von den Angaben aus dem Formular
     * @author Sandra Bodack
     */
    public function createJourney($titel, $beschreibung, $datum_start, $datum_ende, $preis, $max_teilnehmer, $startort) {
        $reiseDAO = new dao\ReiseDAO();
        // Reiseinhalte bestimmen
        $neu_id = $reiseDAO->getNewReiseID();
        $reise = new Reise();
        $reise->setReise_id($neu_id);
        $reise->setTitel($titel);
        $reise->setBeschreibung($beschreibung);
        $reise->setDatum_start($datum_start);
        $reise->setDatum_ende($datum_ende);
        $reise->setPreis($preis);
        $reise->setMax_teilnehmer($max_teilnehmer);
        $reise->setOrt_id($startort);
        $reiseDAO->create($reise);
        return $reise;
    }

    /**
     * Liest anhand der Reise-Id die entsprechende Reise aus der Datenbank
     */
    public function readJourney($reise_id, $titel, $preis, $startort) {
        //if ($this->verifyAuth()) {
        $reiseDAO = new dao\ReiseDAO();
        return $reiseDAO->read($reise_id, $titel, $preis, $startort);
        //}
        //return null;
    }

    public function readSingleJourney($reise_id) {
        $reiseDAO = new \dao\ReiseDAO();
        return $reiseDAO->readSingleJourney($reise_id);
    }
    
    /**
     * Aktualisiert eine bestehende Reise mit neuen Daten (ausser Reise-ID)
     * @author Sandra Bodack
     */
    public function updateJourney($reise_id, $titel, $beschreibung, $datum_start, $datum_ende, $preis, $max_teilnehmer, $startort) {
        //if ($this->verifyAuth()) {
        $reiseDAO = new dao\ReiseDAO();
        return $reiseDAO->update($reise_id, $titel, $beschreibung, $datum_start, $datum_ende, $preis, $max_teilnehmer, $startort);
        //}
        //return null;
    }

    /**
     * Löscht anhand der Reise-ID die entsprechende Reise aus der Datenbank
     */
    public function deleteJourney($reise_id) {
        $reiseDAO = new dao\ReiseDAO();
        $reiseDAO->delete($reise_id);
    }

    /**
     * TODO -> auch in ReiseDAO anpassen -> je nach Anzahl "find"-Methoden müssen auch hier diese entsprechend implementiert werden
     */
    public function findAllJourney() {
        if ($this->verifyAuth()) {
            $reiseDAO = new dao\ReiseDAO();
            return $reiseDAO->findByAgent($this->currentBenutzername); // Methode gibt es so nicht in ReiseDAO
        }
        return null;
    }

    /**
     * Lese Reisename anhand Reise-ID
     */
    public function readJourneyName($reise) {
        //if($this->verifyAuth()){
        $reiseDAO = new dao\ReiseDAO();
        return $reiseDAO->readReiseName($reise);
        //}
        //return null;
    }

    // CRUD-Methoden für Teilnehmer

    /**
     * Erstellt einen neuen Teilnehmer anhand von den Angaben aus dem Formular
     * @author Sandra Bodack
     */
    public function createParticipant($reise, $vorname, $nachname, $geburtsdatum) {
        $teilnehmerDAO = new \dao\TeilnehmerDAO();
        // Teilnehmerinhalte bestimmen      
        $neu_id = $teilnehmerDAO->getNewTeilnehmerID();
        $teilnehmer = new Teilnehmer();
        $teilnehmer->setTeilnehmer_id($neu_id); // hole neue Teilnehmer-ID
        $teilnehmer->setReise($reise);
        $teilnehmer->setVorname($vorname);
        $teilnehmer->setNachname($nachname);
        $teilnehmer->setGeburtsdatum($geburtsdatum);
        $teilnehmerDAO->create($teilnehmer);
        return $teilnehmer;
    }

    /**
     * Liest anhand der Teilnehmer-Id den entsprechenden Teilnehmer aus der Datenbank
     */
    public function readParticipant($reise, $teilnehmer_id, $vorname, $nachname) {
        $teilnehmerDAO = new \dao\TeilnehmerDAO();
        return $teilnehmerDAO->read($reise, $teilnehmer_id, $vorname, $nachname);
    }

    public function readSingleParticipant($teilnehmer_id) {
        $teilnehmerDAO = new \dao\TeilnehmerDAO();
        return $teilnehmerDAO->readSingleParticipant($teilnehmer_id);
    }

    /**
     * Aktualisiert eine bestehende Rechnung mit neuen Daten (ausser Rg-ID)
     * @author Sandra Bodack
     */
    public function updateParticipant($teilnehmer_id, $reise, $vorname, $nachname, $geburtsdatum) {
        $teilnehmerDAO = new \dao\TeilnehmerDAO();
        return $teilnehmerDAO->update($teilnehmer_id, $reise, $vorname, $nachname, $geburtsdatum);
    }
    
//    public function updateParticipant($reise, $teilnehmer_id, $vorname, $nachname) {
//        $teilnehmerDAO = new \dao\TeilnehmerDAO();
//        // Teilnehmerinhalte bestimmen      
//        $teilnehmer = new Teilnehmer();
//        $teilnehmer->setReise($reise);
//        $teilnehmer->setTeilnehmer_id($teilnehmer_id); // hole Teilnehmer-ID
//        $teilnehmer->setVorname($vorname);
//        $teilnehmer->setNachname($nachname);
//        return $teilnehmerDAO->update($teilnehmer);
//    }

    /**
     * Löscht anhand der Teilnehmer-ID den entsprechenden Teilnehmer aus der Datenbank
     */
    public function deleteParticipant($teilnehmer_id) {
        $teilnehmerDAO = new \dao\TeilnehmerDAO();
        $teilnehmerDAO->delete($teilnehmer_id);
    }

    /**
     * TODO -> auch in TeilnehmerDAO anpassen -> je nach Anzahl "find"-Methoden müssen auch hier diese entsprechend implementiert werden
     */
    public function findAllParticipant() {
        if ($this->verifyAuth()) {
            $teilnehmerDAO = new \dao\TeilnehmerDAO();
            return $teilnehmerDAO->findByAgent($this->currentBenutzername); // Methode gibt es so nicht in TeilnehmerDAO
        }
        return null;
    }

    // CRUD-Methoden für Rechnungen

    /**
     * Erstellt eine neue Rechnung anhand angaben aus Formular von Benutzer
     * @author Maja Velickovic
     */
    public function createInvoice($reise, $rgart, $kosten, $beschreibung, $dokument, $pdf_object) {
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
        $rechnungDAO->create($rechnung, $pdf_object);
        return $rechnung;
    }

    /**
     * Liest anhand der Rechnungs-Id die entsprechende Rechnung aus der Datenbank
     * @author Maja Velickovic
     */
    public function readInvoice($reise, $rg_id, $rgart) {
        //if($this->verifyAuth()) {
        $rechnungDAO = new \dao\RechnungDAO();
        return $rechnungDAO->read($reise, $rg_id, $rgart);
        //}
    }

    /**
     * Liest anhand der Rechnungs-Id die entsprechende Rechnung aus der Datenbank
     * @author Maja Velickovic
     */
    public function readSingleInvoice($rg_id) {
        //if($this->verifyAuth()) {
        $rechnungDAO = new \dao\RechnungDAO();
        return $rechnungDAO->readSingleInvoice($rg_id);
        //}
    }

    /**
     * Liest anhand der Rechnungs-Id die entsprechende Rechnung aus der Datenbank
     * @author Maja Velickovic
     */
    public function readFinalBIlling($reise) {
        //if($this->verifyAuth()) {
        $rechnungDAO = new \dao\RechnungDAO();
        return $rechnungDAO->readFinalBilling($reise);
        //}
    }

    /**
     * Aktualisiert eine bestehende Rechnung mit neuen Daten (ausser Rg-ID)
     * @author Maja Velickovic
     */
    public function updateInvoice($rg_id, $reise, $rgart, $kosten, $beschreibung, $dokument, $pdf_object) {
        //if($this->verifyAuth()) {
        $rechnungDAO = new \dao\RechnungDAO();
        return $rechnungDAO->update($rg_id, $reise, $rgart, $kosten, $beschreibung, $dokument, $pdf_object);
        //}
        //return null;
    }

    /**
     * Löscht anhand der Rechnungs-ID die entsprechende Rechnung aus der Datenbank
     * @author Maja Velickovic
     */
    public function deleteInvoice($rechnungId) {
        //if($this->verifyAuth()) {
        $rechnungDAO = new \dao\RechnungDAO();
        $rechnungDAO->delete($rechnungId);
        //}
    }

    /**
     * 
     * Selektabfrage, um alle Rechnungsarten auszulesen
     * @author Michelle Widmer
     */
    public function getInvoiceTypes() {
        $rechnungsDAO = new \dao\RechnungDAO();
        return $rechnungsDAO->getInvoiceTypes();
    }

    /**
     * Selektabfrage, um alle Reisetitel auszulesen
     * @author Maja Velickovic
     */
    public function getJourneyTitles() {
        $reiseDAO = new \dao\ReiseDAO();
        return $reiseDAO->getJourneyTitles();
    }

    /**
     * Lese Rechnungs-PDF aus der Datenbank und gebe das konvertiert als String zurück
     * @author Maja Velickovic
     */
    public function getAttachedPDFInvoice($rg_id) {
        $rechnungDAO = new \dao\RechnungDAO();
        return $rechnungDAO->getAttachedPDFInvoice($rg_id);
    }

}
