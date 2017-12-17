<?php
namespace domain;

/**
 * Diese Klasse stellt Beziehungen zwischen Reisen und Rechnungen dar
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