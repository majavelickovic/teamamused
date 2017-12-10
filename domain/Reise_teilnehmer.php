<?php
require_once(realpath(dirname(__FILE__)) . '/../domain/Reise.php');
require_once(realpath(dirname(__FILE__)) . '/../domain/Teilnehmer.php');

/**
 * Diese Klasse stellt Beziehungen zwischen Reisen und Teilnehmer dar
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