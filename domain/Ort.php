<?php
namespace domain;

/**
 * Diese Klasse stellt Reiseort-Entitäten dar
 */
class Ort {
	/**
	 * @AttributeType int
	 */
	private $_ort_id;
	/**
	 * @AttributeType String
	 */
	private $_ort_name;
	/**
	 * @AssociationType domain.Reise
	 * 
	 * 
	 * @AssociationMultiplicity 0..*
	 */
	private $_reise = array();

	/**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getOrt_id() {
		return $this->_ort_id;
	}

	/**
	 * @access public
	 * @param int aOrt_id
	 * @return void
	 * @ParamType aOrt_id int
	 * @ReturnType void
	 */
	public function setOrt_id(&$ort_id) {
		$this->_ort_id = $ort_id;
	}

	/**
	 * @access public
	 * @return String
	 * @ReturnType String
	 */
	public function getOrt_name() {
		return $this->_ort_name;
	}

	/**
	 * @access public
	 * @param String aOrt_name
	 * @return void
	 * @ParamType aOrt_name String
	 * @ReturnType void
	 */
	public function setOrt_name(&$ort_name) {
		$this->_ort_name = $ort_name;
	}
}
?>