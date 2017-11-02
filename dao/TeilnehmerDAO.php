<?php
/**
 * @access public
 * @author Michelle Widmer
 * 
 * Die Klasse stellt ein Data Access Object für die Klasse Teilnehmer dar und bietet alle CRUD-Operatoren als Prepared Statement an.
 * 
 */

namespace dao;

use domain\Teilnehmer;

class TeilnehmerDAO {

	/**
	 * Erstellt einen neues Teilnehmer-Objekt in der Tabelle "teilnehmer"
	 */
	public function create(Teilnehmer $teilnehmer) {
            
        $pdo = \Database::connect();
        $statement = $pdo->prepare(
                "INSERT INTO teilnehmer (teilnehmer_id, vorname, nachname, telefon, mail, geburtsdatum)
                    VALUES (:teilnehmer_id, :vorname, :nachname, :telefon, :mail, :geburtsdatum)");
        $statement->bindValue(':teilnehmer_id', $teilnehmer->getTeilnehmer_id());
        $statement->bindValue(':vorname', $teilnehmer->getVorname());
        $statement->bindValue(':nachname', $teilnehmer->getNachname());
        $statement->bindValue(':telefon', $teilnehmer->getTelefon());
        $statement->bindValue(':mail', $teilnehmer->getMail());
        $statement->bindValue(':geburtsdatum', $teilnehmer->getGeburtsdatum());
        $statement->execute();
        return $this->read($pdo->lastInsertId());
	}

	/**
	 * Liest ein Teilnehmer-Objekt aus der Tabelle "teilnehmer
	 */
	public function read($_teilnehmer_id) {
        $pdo = \Database::connect();
        $statement = $pdo->prepare(
            "SELECT * FROM teilnehmer WHERE id = :id;");
        $statement->bindValue(':id', $_teilnehmer_id);
        $statement->execute();
       //return $statement->fetchAll(\PDO::FETCH_CLASS, "domain\Teilnehmer")[0]; -> Für was ist diese Zeile?
	}

	/**
	 * Aktualisiert ein Teilnehmer-Objekt in der Tabelle "teilnehmer"
	 */
	public function update(Teilnehmer $teilnehmer) {
        $pdo = \Database::connect();
        $statement = $pdo->prepare(
            "UPDATE customer SET name = :name,
                email = :email,
                mobile = :mobile
            WHERE id = :id");
        $statement->bindValue(':teilnehmer_id', $teilnehmer->getTeilnehmer_id());
        $statement->bindValue(':vorname', $teilnehmer->getVorname());
        $statement->bindValue(':nachname', $teilnehmer->getNachname());
        $statement->bindValue(':telefon', $teilnehmer->getTelefon());
        $statement->bindValue(':mail', $teilnehmer->getMail());
        $statement->bindValue(':geburtsdatum', $teilnehmer->getGeburtsdatum());
        $statement->execute();
        return $this->read($teilnehmer->getId());
	}

	/**
	 * Löscht ein Teilnehmer-Objekt aus der Tabelle "teilnehmer"
	 */
	public function delete(Teilnehmer $teilnehmer) {
        $pdo = \Database::connect();
        $statement = $pdo->prepare(
            "DELETE FROM teilnehmer
            WHERE id = :id");
        $statement->bindValue(':id', $teilnehmer->getTeilnehmer_id());
        $statement->execute();
	}

	/**
	 * noch überarbeiten
	 */
	public function findByXY($xy) {
        $pdo = \Database::connect();
        $statement = $pdo->prepare('
            SELECT * FROM teilnehmer WHERE xy = :xy ORDER BY id;');
        $statement->bindValue(':xy', $xy);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, "domain\Teilnehmer");
	}
}
?>