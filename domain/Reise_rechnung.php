<?php
require_once(realpath(dirname(__FILE__)) . '/../domain/Rechnung.php');
require_once(realpath(dirname(__FILE__)) . '/../domain/Reise.php');

/**
 * @access public
 * @author majav
 * @package domain
 */
class Reise_rechnung {
	/**
	 * @AssociationType domain.Rechnung
	 * 
	 * 
	 * @AssociationMultiplicity 1
	 */
	private $_rg;
	/**
	 * @AssociationType domain.Reise
	 * 
	 * 
	 * @AssociationMultiplicity 1
	 */
	private $_reise;
}
?>