<?php
namespace domain;

/**
 * @access public
 * @author majav
 * @package domain
 */
class Rechnung {
	/**
	 * @AttributeType int
	 */
	private $_rg_id;
	/**
	 * @AttributeType double
	 */
	private $_kosten;
	/**
	 * @AttributeType String
	 */
	private $_beschreibung;
	/**
	 * @AttributeType String
	 */
	private $_dokument;
	/**
	 * @AttributeType int
	 */
	private $_rechnungsart;
	/**
	 * @AttributeType int
	 */
	private $_reise;
	/**
	 * @AssociationType domain.Rechnungsart
	 * @AssociationMultiplicity 1
	 */
	public function getKosten() {
		return $this->_kosten;
	}

	/**
	 * @access public
	 * @param double aKosten
	 * @return void
	 * @ParamType aKosten double
	 * @ReturnType void
	 */
	public function setKosten(&$aKosten) {
		$this->_kosten = $aKosten;
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
	 * @return String
	 * @ReturnType String
	 */
	public function getDokument() {
		return $this->_dokument;
	}

	/**
	 * @access public
	 * @param String aDokument
	 * @return void
	 * @ParamType aDokument String
	 * @ReturnType void
	 */
	public function setDokument(&$aDokument) {
		$this->_dokument = $aDokument;
	}

	/**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getRg_id() {
		return $this->_rg_id;
	}

	/**
	 * @access public
	 * @param int aRg_id
	 * @return void
	 * @ParamType aRg_id int
	 * @ReturnType void
	 */
	public function setRg_id(&$aRg_id) {
		$this->_rg_id = $aRg_id;
	}
        
        /**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getReise() {
		return $this->_reise;
	}

	/**
	 * @access public
	 * @param int aReise
	 * @return void
	 * @ParamType aReise int
	 * @ReturnType void
	 */
	public function setReise(&$aReise) {
		$this->_reise = $aReise;
	}
        
        /**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getRechnungsart() {
		return $this->_rechnungsart;
	}

	/**
	 * @access public
	 * @param int $aRechnungsart
	 * @return void
	 * @ParamType $aRechnungsart int
	 * @ReturnType void
	 */
	public function setRechnungsart(&$aRechnungsart) {
		$this->_rechnungsart = $aRechnungsart;
	}
}
?>