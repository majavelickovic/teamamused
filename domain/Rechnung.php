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
	private $_reise_id;
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
	public function setKosten($kosten) {
		$this->_kosten = $kosten;
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
	public function setBeschreibung($beschreibung) {
		$this->_beschreibung = $beschreibung;
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
	public function setDokument($dokument) {
		$this->_dokument = $dokument;
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
	public function setRg_id($rg_id) {
		$this->_rg_id = $rg_id;
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
	 * @param int aReise
	 * @return void
	 * @ParamType aReise int
	 * @ReturnType void
	 */
	public function setReise($reise_id) {
		$this->_reise = $reise_id;
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
	public function setRechnungsart($rechnungsart) {
		$this->_rechnungsart = $rechnungsart;
	}
}
?>