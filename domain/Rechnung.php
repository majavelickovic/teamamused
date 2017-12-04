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
         * @AttributeType blob
         */
        private $_pdf_object;
	/**
	 * @AssociationType domain.Rechnungsart
	 * @AssociationMultiplicity 1
	 */
	public function getKosten() {
		return $this->_kosten;
	}

	/**
	 * @access public
	 * @param double $kosten
	 * @return void
	 * @ParamType $kosten double
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
	 * @param String $beschreibung
	 * @return void
	 * @ParamType $beschreibung String
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
	 * @param String $dokument
	 * @return void
	 * @ParamType $dokument String
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
	 * @param int $rg_id
	 * @return void
	 * @ParamType $rg_id int
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
	 * @param int $reise_id
	 * @return void
	 * @ParamType $reise_id int
	 * @ReturnType void
	 */
	public function setReise($reise_id) {
		$this->_reise_id = $reise_id;
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
	 * @param int $rechnungsart
	 * @return void
	 * @ParamType $aRechnungsart int
	 * @ReturnType void
	 */
	public function setRechnungsart($rechnungsart) {
		$this->_rechnungsart = $rechnungsart;
	}
        
                
        /**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getPdf_Object() {
		return $this->_pdf_object;
	}

	/**
	 * @access public
	 * @param int $pdf_object
	 * @return void
	 * @ParamType $pdf_object int
	 * @ReturnType void
	 */
	public function setPdf_Object($pdf_object) {
		$this->_rechnungsart = $pdf_object;
	}
}
?>