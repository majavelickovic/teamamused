<?php
/**
 * @access public
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Die Klasse stellt ein Data Access Object für die Klasse Reise dar und bietet alle CRUD-Operatoren als Prepared Statement an.
 * 
 */

namespace dao;

use Reise;
use Database;

class ReiseDAO {

	/**
	 * Erstellt einen neues Reise-Objekt in der Tabelle "reise"
	 */
	public function create(Reise $reise) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "INSERT INTO reise (reise_id, beschreibung, datum_start, datum_ende, preis, reiseleiter, fahrer, max_teilnehmer, startort)
                    VALUES (:reise_id, :beschreibung, :datum_start, :datum_ende, :preis, :reiseleiter, :fahrer, :max_teilnehmer, :startort)");
        $statement->bindValue(':reise_id', $reise->getReise_id());
        $statement->bindValue(':beschreibung', $reise->getBeschreibung());
        $statement->bindValue(':datum_start', $reise->getDatum_start());
        $statement->bindValue(':datum_ende', $reise->getDatum_ende());
        $statement->bindValue(':preis', $reise->getPreis());
        //$statement->bindValue(':reiseleiter', $reise->get()); -> kein Getter vorhanden
        //$statement->bindValue(':fahrer', $reise->get()); -> kein Getter vorhanden
        $statement->bindValue(':max_teilnehmer', $reise->getMax_teilnehmer());
        //$statement->bindValue(':startort', $reise->get()); -> kein Getter vorhanden
        $statement->execute();
        return $this->read($pdo->lastInsertId());
	}

	/**
	 * Liest ein Reise-Objekt aus der Tabelle "reise
	 */
	public function read($_reise_id) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
            "SELECT * FROM reise WHERE reise_id = :reise_id;");
        $statement->bindValue(':reise_id', $_reise_id);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, "Reise")[0];
	}

	/**
	 * Aktualisiert ein Reise-Objekt in der Tabelle "reise"
	 */
	public function update(Reise $reise) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
            "UPDATE reise SET beschreibung = :beschreibung, datum_start = :datum_start, datum_ende = :datum_ende, preis = :preis, reiseleiter = :reiseleiter, fahrer = :fahrer, max_teilnehmer = :max_teilnehmer, startort = :startort
            WHERE reise_id = :reise_id");
        $statement->bindValue(':reise_id', $reise->getReise_id());
        $statement->bindValue(':beschreibung', $reise->getBeschreibung());
        $statement->bindValue(':datum_start', $reise->getDatum_start());
        $statement->bindValue(':datum_ende', $reise->getDatum_ende());
        $statement->bindValue(':preis', $reise->getPreis());
        //$statement->bindValue(':reiseleiter', $reise->get()); -> kein Getter vorhanden
        //$statement->bindValue(':fahrer', $reise->get()); -> kein Getter vorhanden
        $statement->bindValue(':max_teilnehmer', $reise->getMax_teilnehmer());
        //$statement->bindValue(':startort', $reise->get()); -> kein Getter vorhanden
        $statement->execute();
        return $this->read($reise->getReise_id());
	}

	/**
	 * Löscht ein Reise-Objekt aus der Tabelle "reise"
	 */
	public function delete(Reise $reise) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
            "DELETE FROM reise
            WHERE reise_id = :reise_id");
        $statement->bindValue(':rg_id', $reise->getReise_id());
        $statement->execute();
	}

	/**
	 * noch überarbeiten
	 */
	public function findByXY($xy) {
        $pdo = Database::connect();
        $statement = $pdo->prepare('
            SELECT * FROM reise WHERE xy = :xy ORDER BY id;');
        $statement->bindValue(':xy', $xy);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, "Reise");
        }
        
        public function readReiseName($reise) {
            $pdo = Database::connect();
            $statement = $pdo->prepare('
                SELECT beschreibung FROM reise WHERE reise_id = :reise;');
            $statement->bindValue(':reise', $reise);
            $statement->execute();
            return $statement->fetchAll();
        }
}
?>