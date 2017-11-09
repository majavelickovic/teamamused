<?php
require_once(realpath(dirname(__FILE__)) . '/../domain/Reise.php');
require_once(realpath(dirname(__FILE__)) . '/../domain/Teilnehmer.php');

/**
 * @access public
 * @author majav
 * @package domain
 */
class Reise_teilnehmer {
	/**
	 * @AssociationType domain.Reise
	 * 
	 * 
	 * @AssociationMultiplicity 1
	 */
	private $_reise;
	/**
	 * @AssociationType domain.Teilnehmer
	 * 
	 * 
	 * @AssociationMultiplicity 1
	 */
	private $_teilnehmer;
}
?>