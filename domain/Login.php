<?php

namespace domain;

/**
 * Diese Klasse stellt Mitarbeiter-Entitäten dar
 */
class Login {
    
        /**
	 * @AttributeType String
	 */
	private $_benutzername;
	/**
	 * @AttributeType String
	 */
	private $_passwort;
	/**
	 * @AttributeType String
	 */
	private $_vorname;
	/**
	 * @AttributeType String
	 */
	private $_nachname;
	/**
	 * @AssociationType domain.Rolle
	 * 
	 * 
	 * @AssociationMultiplicity 1
	 */
	private $_rolle;
	/**
	 * @AttributeType domain.Reise[]
	 * 
	 * 
	 * @AssociationMultiplicity 0..*
	 */
	private $_reise = array();
	/**
	 * @AssociationType domain.Reise
	 * 
	 * 
	 * @AssociationMultiplicity 0..*
	 */
	private $_reise1 = array();
	/**
	 * @AssociationType domain.Rolle
	 * @AssociationMultiplicity 1
	 */
	public $_rolle2;
	/**
	 * @AssociationType domain.Reise
	 * @AssociationMultiplicity 0..*
	 */
	public $_reise2 = array();

        
        /**
	 * @access public
	 * @return String
	 * @ReturnType String
	 */
	public function getBenutzername() {
		return $this->_benutzername;
	}

	/**
	 * @access public
	 * @param String aBenutzername
	 * @return void
	 * @ParamType aBenutzername String
	 * @ReturnType void
	 */
	public function setBenutzername(&$aBenutzername) {
		$this->_benutzername = $aBenutzername;
	}

	/**
	 * @access public
	 * @return String
	 * @ReturnType String
	 */
	public function getPasswort() {
		return $this->_passwort;
	}

	/**
	 * @access public
	 * @param String aPasswort
	 * @return void
	 * @ParamType aPasswort String
	 * @ReturnType void
	 */
	public function setPasswort(&$aPasswort) {
		$this->_passwort = $aPasswort;
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
        
        public function getRolle() {
            return $this->_rolle;
        }
}
?>