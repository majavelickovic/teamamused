<?php
/**
 * @access public
 * @author Michelle Widmer
 * 
 * Die Klasse stellt ein Data Access Object für die Klasse Rechnung dar und bietet alle CRUD-Operatoren als Prepared Statement an.
 * 
 */

namespace dao;

use Rechnung;
use Database;

class RechnungDAO {

	/**
	 * Erstellt einen neues Rechnungs-Objekt in der Tabelle "rechnung"
	 */
	public function create(Rechnung $rechnung) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "INSERT INTO rechnung (rg_id, rechnungsart, kosten, beschreibung, dokument)
                    VALUES (:rg_id, :rechnungsart, :kosten, :beschreibung, :dokument)");
        $statement->bindValue(':rg_id', $rechnung->getRg_id());
        //$statement->bindValue(':rechnungsart', $rechnung->get()); -> Kein Getter vorhanden
        $statement->bindValue(':kosten', $rechnung->getKosten());
        $statement->bindValue(':beschreibung', $rechnung->getBeschreibung());
        $statement->bindValue(':dokument', $rechnung->getDokument());
        $statement->execute();
        return $this->read($pdo->lastInsertId());
	}

	/**
	 * Liest ein Rechnungs-Objekt aus der Tabelle "rechnung
	 */
	public function read($_rg_id) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
            "SELECT * FROM rechnung WHERE rg_id = :rg_id;");
        $statement->bindValue(':rg_id', $_rg_id);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, "Rechnung")[0];
	}

	/**
	 * Aktualisiert ein Rechnungs-Objekt in der Tabelle "rechnung"
	 */
	public function update(Rechnung $rechnung) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
            "UPDATE rechnung SET rechnungsart = :rechnungsart, kosten = :kosten, beschreibung = :beschreibung, dokument = :dokument
            WHERE rg_id = :rg_id");
        $statement->bindValue(':rg_id', $rechnung->getRg_id());
        //$statement->bindValue(':rechnungsart', $rechnung->get()); -> Kein Getter vorhanden
        $statement->bindValue(':kosten', $rechnung->getKosten());
        $statement->bindValue(':beschreibung', $rechnung->getBeschreibung());
        $statement->bindValue(':dokument', $rechnung->getDokument());
        $statement->execute();
        return $this->read($rechnung->getRg_id());
	}

	/**
	 * Löscht ein Rechnungs-Objekt aus der Tabelle "rechnung"
	 */
	public function delete(Rechnung $rechnung) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
            "DELETE FROM rechnung
            WHERE rg_id = :rg_id");
        $statement->bindValue(':rg_id', $rechnung->getRg_id());
        $statement->execute();
	}

	/**
	 * noch überarbeiten
	 */
	public function findByXY($xy) {
        $pdo = Database::connect();
        $statement = $pdo->prepare('
            SELECT * FROM rechnung WHERE xy = :xy ORDER BY id;');
        $statement->bindValue(':xy', $xy);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, "Rechnung");
        }
}
?>