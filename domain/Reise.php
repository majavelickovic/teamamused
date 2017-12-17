<?php
namespace domain;

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
	private $_titel;
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
	public function setReise_id(&$reise_id) {
		$this->_reise_id = $reise_id;
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
	 * @param String Beschreibung
	 * @return void
	 * @ParamType Beschreibung String
	 * @ReturnType void
	 */
	public function setBeschreibung(&$beschreibung) {
		$this->_beschreibung = $beschreibung;
	}
        
	/**
	 * @access public
	 * @return String
	 * @ReturnType String
	 */
	public function getTitel() {
		return $this->_titel;
	}

	/**
	 * @access public
	 * @param String Titel
	 * @return void
	 * @ParamType Titel String
	 * @ReturnType void
	 */
	public function setTitel(&$titel) {
		$this->_titel = $titel;
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
	 * @param Date datum_start
	 * @return void
	 * @ParamType datum_start Date
	 * @ReturnType void
	 */
	public function setDatum_start(&$datum_start) {
		$this->_datum_start = $datum_start;
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
	 * @param Date datum_ende
	 * @return void
	 * @ParamType datum_ende Date
	 * @ReturnType void
	 */
	public function setDatum_ende(&$datum_ende) {
		$this->_datum_ende = $datum_ende;
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
	 * @param Double preis
	 * @return void
	 * @ParamType preis Double
	 * @ReturnType void
	 */
	public function setPreis(&$preis) {
		$this->_preis = $preis;
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
	 * @param Integer max_teilnehmer
	 * @return void
	 * @ParamType max_teilnehmer Integer
	 * @ReturnType void
	 */
	public function setMax_teilnehmer(&$max_teilnehmer) {
		$this->_max_teilnehmer = $max_teilnehmer;
	}
        
        /**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getOrt_id() {
		return $this->_startort;
	}

	/**
	 * @access public
	 * @param int aReise_id
	 * @return void
	 * @ParamType aReise_id int
	 * @ReturnType void
	 */
	public function setOrt_id(&$startort) {
		$this->_startort = $startort;
	}
        
}
?>