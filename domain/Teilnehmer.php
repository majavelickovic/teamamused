<?php
require_once(realpath(dirname(__FILE__)) . '/../domain/Reise_teilnehmer.php');

/**
 * @access public
 * @author majav
 * @package domain
 */
class Teilnehmer {
	/**
	 * @AttributeType int
	 */
	private $_teilnehmer_id;
	/**
	 * @AttributeType String
	 */
	private $_vorname;
	/**
	 * @AttributeType String
	 */
	private $_nachname;
	/**
	 * @AttributeType Integer
	 */
	private $_telefon;
	/**
	 * @AttributeType String
	 */
	private $_mail;
	/**
	 * @AttributeType Date
	 */
	private $_geburtsdatum;
	/**
	 * @AttributeType int
	 */
	private $_teilnehmer_id;
	/**
	 * @AttributeType String
	 */
	private $_vorname;
	/**
	 * @AttributeType String
	 */
	private $_nachname;
	/**
	 * @AttributeType Integer
	 */
	private $_telefon;
	/**
	 * @AttributeType String
	 */
	private $_mail;
	/**
	 * @AttributeType Date
	 */
	private $_geburtsdatum;
	/**
	 * @AssociationType domain.Reise_teilnehmer
	 * 
	 * 
	 * @AssociationMultiplicity 1..*
	 */
	private $_reise_teilnehmer = array();
	/**
	 * @AssociationType domain.Reise_teilnehmer
	 * @AssociationMultiplicity 1..*
	 */
	public $_reise_teilnehmer = array();

	/**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getTeilnehmer_id() {
		return $this->_teilnehmer_id;
	}

	/**
	 * @access public
	 * @param int aTeilnehmer_id
	 * @return void
	 * @ParamType aTeilnehmer_id int
	 * @ReturnType void
	 */
	public function setTeilnehmer_id(&$aTeilnehmer_id) {
		$this->_teilnehmer_id = $aTeilnehmer_id;
	}

	/**
	 * @access public
	 * @return String
	 * @ReturnType String
	 */
	public function getVorname() {
		return $this->_vorname;
	}

	/**
	 * @access public
	 * @param String aVorname
	 * @return void
	 * @ParamType aVorname String
	 * @ReturnType void
	 */
	public function setVorname(&$aVorname) {
		$this->_vorname = $aVorname;
	}

	/**
	 * @access public
	 * @return String
	 * @ReturnType String
	 */
	public function getNachname() {
		return $this->_nachname;
	}

	/**
	 * @access public
	 * @param String aNachname
	 * @return void
	 * @ParamType aNachname String
	 * @ReturnType void
	 */
	public function setNachname(&$aNachname) {
		$this->_nachname = $aNachname;
	}

	/**
	 * @access public
	 * @return Integer
	 * @ReturnType Integer
	 */
	public function getTelefon() {
		return $this->_telefon;
	}

	/**
	 * @access public
	 * @param Integer aTelefon
	 * @return void
	 * @ParamType aTelefon Integer
	 * @ReturnType void
	 */
	public function setTelefon(&$aTelefon) {
		$this->_telefon = $aTelefon;
	}

	/**
	 * @access public
	 * @return String
	 * @ReturnType String
	 */
	public function getMail() {
		return $this->_mail;
	}

	/**
	 * @access public
	 * @param String aMail
	 * @return void
	 * @ParamType aMail String
	 * @ReturnType void
	 */
	public function setMail(&$aMail) {
		$this->_mail = $aMail;
	}

	/**
	 * @access public
	 * @return Date
	 * @ReturnType Date
	 */
	public function getGeburtsdatum() {
		return $this->_geburtsdatum;
	}

	/**
	 * @access public
	 * @param Date aGeburtsdatum
	 * @return void
	 * @ParamType aGeburtsdatum Date
	 * @ReturnType void
	 */
	public function setGeburtsdatum(&Date $aGeburtsdatum) {
		$this->_geburtsdatum = $aGeburtsdatum;
	}
}
?>