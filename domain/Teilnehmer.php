<?php
namespace domain;

/**
 * Diese Klasse stellt Teilnehmer-Entitäten dar
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
	 * @AttributeType Date
	 */
	private $_geburtsdatum;
	/**
	 * @AttributeType int
	 */
	private $_reise_teilnehmer = array();
        /**
	 * @AttributeType int
	 */
	private $_reise_id;
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
	public function setTeilnehmer_id(&$teilnehmer_id) {
		$this->_teilnehmer_id = $teilnehmer_id;
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
	public function setVorname(&$vorname) {
		$this->_vorname = $vorname;
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
	public function setNachname(&$nachname) {
		$this->_nachname = $nachname;
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
	public function setGeburtsdatum(&$geburtsdatum) {
		$this->_geburtsdatum = $geburtsdatum;
	}
        
        /**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getReise() {
		return $this->_reise_id;
	}

	/**
	 * @access public
	 * @param int $reise_id
	 * @return void
	 * @ParamType $reise_id int
	 * @ReturnType void
	 */
	public function setReise($reise_id) {
		$this->_reise_id = $reise_id;
	}
}
?>