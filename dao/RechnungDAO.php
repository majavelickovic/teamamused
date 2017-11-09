<?php
/**
 * @access public
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Die Klasse stellt ein Data Access Object für die Klasse Rechnung dar und bietet alle CRUD-Operatoren als Prepared Statement an.
 * 
 */

namespace dao;

use domain\Rechnung;
use database\Database;
use PDO;

class RechnungDAO {

	/**
	 * Erstellt einen neues Rechnungs-Objekt in der Tabelle "rechnung" und "reise_rechnung"
	 */
	public function create(Rechnung $rechnung) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "INSERT INTO rechnung (rg_id, rechnungsart, kosten, beschreibung, dokument)
                    VALUES (:rg_id, :rechnungsart, :kosten, :beschreibung, :dokument)");
        $statement->bindValue(':rg_id', $rechnung->getRg_id());
        $statement->bindValue(':rechnungsart', $rechnung->getRechnungsart());
        $statement->bindValue(':kosten', $rechnung->getKosten());
        $statement->bindValue(':beschreibung', $rechnung->getBeschreibung());
        $statement->bindValue(':dokument', $rechnung->getDokument());
        $statement->execute();
        
        $statement2 = $pdo->prepare(
                "INSERT INTO reise_rechnung (reise_id, rg_id)
                    VALUES (:reise, :rg_id)");
        $statement2->bindValue(':reise', $rechnung->getReise());
        $statement2->bindValue(':rg_id', $rechnung->getRg_id());
        $statement2->execute();
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
        return $statement->fetchAll(PDO::FETCH_CLASS, "Rechnung")[0];
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
	 * Lese die letzte Rechnungsnummer und gib +1 zurück für neue ID einer Rechnung
	 */
	public function getNewRgID() {
            $pdo = Database::connect();
            $query = $pdo->query(
                "SELECT rg_id FROM rechnung
                ORDER BY rg_id DESC LIMIT 1");
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $returnvalue = $row["rg_id"];
            }
            return $returnvalue+1;
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