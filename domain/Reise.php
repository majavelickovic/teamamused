<?php
require_once(realpath(dirname(__FILE__)) . '/../domain/Ort.php');
require_once(realpath(dirname(__FILE__)) . '/../domain/Login.php');
require_once(realpath(dirname(__FILE__)) . '/../domain/Reise_rechnung.php');
require_once(realpath(dirname(__FILE__)) . '/../domain/Reise_teilnehmer.php');

/**
 * Diese Klasse stellt Reise-Entitäten dar
 */
class Reise {
	/**
	 * @AttributeType int
	 */
	private $_reise_id;
	/**
	 * @AttributeType String
	 */
	private $_beschreibung;
	/**
	 * @AttributeType Date
	 */
	private $_datum_start;
	/**
	 * @AttributeType Date
	 */
	private $_datum_ende;
	/**
	 * @AttributeType Double
	 */
	private $_preis;
	/**
	 * @AttributeType Integer
	 */
	private $_max_teilnehmer;
	/**
	 * @AssociationType domain.Ort
	 * 
	 * 
	 * @AssociationMultiplicity 1
	 */
	private $_startort;
	/**
	 * @AssociationType domain.Login
	 * 
	 * 
	 * @AssociationMultiplicity 1
	 */
	private $_reiseleiter;
	/**
	 * @AssociationType domain.Login
	 * 
	 * 
	 * @AssociationMultiplicity 1
	 */
	private $_fahrer;
	/**
	 * @AssociationType domain.Reise_rechnung
	 * 
	 * 
	 * @AssociationMultiplicity 1..*
	 */
	private $_reise_rechnung = array();
	/**
	 * @AssociationType domain.Reise_teilnehmer
	 * 
	 * 
	 * @AssociationMultiplicity 1..*
	 */
	private $_reise_teilnehmer = array();

	/**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getReise_id() {
		return $this->_reise_id;
	}

	/**
	 * @access public
	 * @param int aReise_id
	 * @return void
	 * @ParamType aReise_id int
	 * @ReturnType void
	 */
	public function setReise_id(&$aReise_id) {
		$this->_reise_id = $aReise_id;
	}

	/**
	 * @access public
	 * @return String
	 * @ReturnType String
	 */
	public function getBeschreibung() {
		return $this->_beschreibung;
	}

	/**
	 * @access public
	 * @param String aBeschreibung
	 * @return void
	 * @ParamType aBeschreibung String
	 * @ReturnType void
	 */
	public function setBeschreibung(&$aBeschreibung) {
		$this->_beschreibung = $aBeschreibung;
	}

	/**
	 * @access public
	 * @return Date
	 * @ReturnType Date
	 */
	public function getDatum_start() {
		return $this->_datum_start;
	}

	/**
	 * @access public
	 * @param Date aDatum_start
	 * @return void
	 * @ParamType aDatum_start Date
	 * @ReturnType void
	 */
	public function setDatum_start(&$aDatum_start) {
		$this->_datum_start = $aDatum_start;
	}

	/**
	 * @access public
	 * @return Date
	 * @ReturnType Date
	 */
	public function getDatum_ende() {
		return $this->_datum_ende;
	}

	/**
	 * @access public
	 * @param Date aDatum_ende
	 * @return void
	 * @ParamType aDatum_ende Date
	 * @ReturnType void
	 */
	public function setDatum_ende(&$aDatum_ende) {
		$this->_datum_ende = $aDatum_ende;
	}

	/**
	 * @access public
	 * @return Double
	 * @ReturnType Double
	 */
	public function getPreis() {
		return $this->_preis;
	}

	/**
	 * @access public
	 * @param Double aPreis
	 * @return void
	 * @ParamType aPreis Double
	 * @ReturnType void
	 */
	public function setPreis(&$aPreis) {
		$this->_preis = $aPreis;
	}

	/**
	 * @access public
	 * @return Integer
	 * @ReturnType Integer
	 */
	public function getMax_teilnehmer() {
		return $this->_max_teilnehmer;
	}

	/**
	 * @access public
	 * @param Integer aMax_teilnehmer
	 * @return void
	 * @ParamType aMax_teilnehmer Integer
	 * @ReturnType void
	 */
	public function setMax_teilnehmer(&$aMax_teilnehmer) {
		$this->_max_teilnehmer = $aMax_teilnehmer;
	}
}
?>