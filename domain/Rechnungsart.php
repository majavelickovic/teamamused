<?php
require_once(realpath(dirname(__FILE__)) . '/../domain/Rechnung.php');

/**
 * @access public
 * @author majav
 * @package domain
 */
class Rechnungsart {
	/**
	 * @AttributeType int
	 */
	private $_rgart_id;
	/**
	 * @AttributeType String
	 */
	private $_beschreibung;
	/**
	 * @AssociationType domain.Rechnung
	 * 
	 * 
	 * @AssociationMultiplicity 0..*
	 */
	private $_rechnung = array();

	/**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getRgart_id() {
		return $this->_rgart_id;
	}

	/**
	 * @access public
	 * @param int aRgart_id
	 * @return void
	 * @ParamType aRgart_id int
	 * @ReturnType void
	 */
	public function setRgart_id(&$aRgart_id) {
		$this->_rgart_id = $aRgart_id;
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
}
?>