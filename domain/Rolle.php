<?php
require_once(realpath(dirname(__FILE__)) . '/../domain/Login.php');

/**
 * @access public
 * @author majav
 * @package domain
 */
class Rolle {
	/**
	 * @AttributeType int
	 */
	private $_rolle_id;
	/**
	 * @AttributeType String
	 */
	private $_bezeichnung;
	/**
	 * @AttributeType int
	 */
	private $_rolle_id;
	/**
	 * @AttributeType String
	 */
	private $_bezeichnung;
	/**
	 * @AssociationType domain.Login
	 * 
	 * 
	 * @AssociationMultiplicity 1..*
	 */
	private $_login = array();
	/**
	 * @AssociationType domain.Login
	 * @AssociationMultiplicity 1..*
	 */
	public $_login = array();

	/**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getRolle_id() {
		return $this->_rolle_id;
	}

	/**
	 * @access public
	 * @param int aRolle_id
	 * @return void
	 * @ParamType aRolle_id int
	 * @ReturnType void
	 */
	public function setRolle_id(&$aRolle_id) {
		$this->_rolle_id = $aRolle_id;
	}

	/**
	 * @access public
	 * @return String
	 * @ReturnType String
	 */
	public function getBezeichnung() {
		return $this->_bezeichnung;
	}

	/**
	 * @access public
	 * @param String aBezeichnung
	 * @return void
	 * @ParamType aBezeichnung String
	 * @ReturnType void
	 */
	public function setBezeichnung(&$aBezeichnung) {
		$this->_bezeichnung = $aBezeichnung;
	}
}
?>