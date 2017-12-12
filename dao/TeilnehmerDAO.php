<?php

/**
 * @access public
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Die Klasse stellt ein Data Access Object für die Klasse Teilnehmer dar und bietet alle CRUD-Operatoren als Prepared Statement an.
 * 
 */

namespace dao;

use domain\Teilnehmer;
use database\Database;
use PDO;

class TeilnehmerDAO {

    /**
     * Erstellt einen neues Teilnehmer-Objekt in der Tabelle "teilnehmer"
     */
    public function create(Teilnehmer $teilnehmer) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "INSERT INTO teilnehmer (teilnehmer_id, vorname, nachname, geburtsdatum)
                    VALUES (:teilnehmer_id, :vorname, :nachname, :geburtsdatum)");
        $statement->bindValue(':teilnehmer_id', $teilnehmer->getTeilnehmer_id());
        $statement->bindValue(':vorname', $teilnehmer->getVorname());
        $statement->bindValue(':nachname', $teilnehmer->getNachname());
        //$statement->bindValue(':geburtsdatum', $teilnehmer->getGeburtsdatum());
        $statement->bindValue(':geburtsdatum', "1989-08-20");
        $statement->execute();

        $statement2 = $pdo->prepare(
                "INSERT INTO reise_teilnehmer (reise_id, teilnehmer_id)
                        VALUES (:reise, :teilnehmer_id)");
        $statement2->bindValue(':reise', $teilnehmer->getReise());
        $statement2->bindValue(':teilnehmer_id', $teilnehmer->getTeilnehmer_id());
        $statement2->execute();
    }

    /**
     * Liest ein Teilnehmer-Objekt aus der Tabelle "teilnehmer
     */
    public function read($_teilnehmer_id) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "SELECT * FROM teilnehmer WHERE teilnehmer_id = :teilnehmer_id;");
        $statement->bindValue(':teilnehmer_id', $_teilnehmer_id);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, "Teilnehmer")[0];
    }

    /**
     * Aktualisiert ein Teilnehmer-Objekt in der Tabelle "teilnehmer"
     */
    public function update(Teilnehmer $teilnehmer) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "UPDATE teilnehmer SET vorname = :vorname, nachname = :nachname,telefon = :telefon, mail = :mail, geburtsdatum = :geburtsdatum
            WHERE teilnehmer_id = :teilnehmer_id");
        $statement->bindValue(':teilnehmer_id', $teilnehmer->getTeilnehmer_id());
        $statement->bindValue(':vorname', $teilnehmer->getVorname());
        $statement->bindValue(':nachname', $teilnehmer->getNachname());
        $statement->bindValue(':geburtsdatum', $teilnehmer->getGeburtsdatum());
        $statement->execute();
        return $this->read($teilnehmer->getId());
    }

    /**
     * Löscht ein Teilnehmer-Objekt aus der Tabelle "teilnehmer"
     */
    public function delete(Teilnehmer $teilnehmer) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "DELETE FROM teilnehmer
            WHERE teilnehmer_id = :teilnehmer_id");
        $statement->bindValue(':id', $teilnehmer->getTeilnehmer_id());
        $statement->execute();
    }

    /**
     * noch überarbeiten, je nach Find-Möglichkeiten
     */
    public function findByXY($xy) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "SELECT * FROM teilnehmer WHERE xy = :xy ORDER BY id;");
        $statement->bindValue(':xy', $xy);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, "Teilnehmer");
    }

    public function getNewTeilnehmerID() {
        $pdo = Database::connect();
        $statement = $pdo->query(
                "SELECT teilnehmer_id FROM teilnehmer
                ORDER BY teilnehmer_id DESC LIMIT 1");
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $returnvalue = $row["teilnehmer_id"];
        }
        return $returnvalue + 1;
    }

}

?>