<?php

/**
 * @access public
 * @author Sandra Bodack, Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Die Klasse stellt ein Data Access Object für die Klasse Reise dar und bietet alle CRUD-Operatoren als Prepared Statement an.
 * 
 */

namespace dao;

use domain\Reise;
use database\Database;
use PDO;

class ReiseDAO {

    /**
     * Erstellt ein neues Reise-Objekt in der Tabelle "reise"
     */
    public function create(Reise $reise) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "INSERT INTO reise (reise_id, titel, beschreibung, datum_start, datum_ende, preis, max_teilnehmer, startort)
                    VALUES (:reise_id, :titel, :beschreibung, :datum_start, :datum_ende, :preis, :max_teilnehmer, :startort)");
        $statement->bindValue(':reise_id', $reise->getReise_id());
        $statement->bindValue(':titel', $reise->getTitel());
        $statement->bindValue(':beschreibung', $reise->getBeschreibung());
        $statement->bindValue(':datum_start', $reise->getDatum_start());
        $statement->bindValue(':datum_ende', $reise->getDatum_ende());
        $statement->bindValue(':preis', $reise->getPreis());
        $statement->bindValue(':max_teilnehmer', $reise->getMax_teilnehmer());
        $statement->bindValue(':startort', $reise->getStartort());
        $statement->execute();

        $statement2 = $pdo->prepare(
                "INSERT INTO reise_rechnung (reise_id, rg_id)
                        VALUES (:reise, :rg_id)");
        $statement2->bindValue(':reise', $reise->getReise());
        $statement2->bindValue(':rg_id', $reise->getRg_id());
        $statement2->execute();

        $statement3 = $pdo->prepare(
                "INSERT INTO reise_teilnehmer (reise_id, teilnehmer_id)
                        VALUES (:reise, :teilnehmer_id)");
        $statement3->bindValue(':reise', $reise->getReise());
        $statement3->bindValue(':teilnehmer_id', $reise->getTeilnehmer_id());
        $statement3->execute();
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
                "UPDATE reise SET titel = :titel, beschreibung = :beschreibung, datum_start = :datum_start, datum_ende = :datum_ende, preis = :preis, max_teilnehmer = :max_teilnehmer, startort = :startort
            WHERE reise_id = :reise_id");
        $statement->bindValue(':reise_id', $reise->getReise_id());
        $statement->bindValue(':titel', $reise->getTitel());
        $statement->bindValue(':beschreibung', $reise->getBeschreibung());
        $statement->bindValue(':datum_start', $reise->getDatum_start());
        $statement->bindValue(':datum_ende', $reise->getDatum_ende());
        $statement->bindValue(':preis', $reise->getPreis());
        $statement->bindValue(':max_teilnehmer', $reise->getMax_teilnehmer());
        $statement->bindValue(':startort', $reise->getStartort());
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
        $statement->bindValue(':reise_id', $reise->getReise_id());
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

    public function getNewReiseID() {
        $pdo = Database::connect();
        $statement = $pdo->query(
                "SELECT reise_id FROM reise
                ORDER BY reise_id DESC LIMIT 1");
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $returnvalue = $row["reise_id"];
        }
        return $returnvalue + 1;
    }

    /**
     * 
     * @param type $reise
     * @return Titel einer spezifischen Reise
     * @author Maja Velickovic
     */
    public function readReiseName($reise) {
        $pdo = Database::connect();
        $statement = $pdo->prepare("SELECT titel FROM reise WHERE reise_id = :reise;");
        $statement->bindValue(':reise', $reise);
        $statement->execute();
        while ($row = $statement->fetch()) {
            $reisename = $row['titel'];
        }
        return $reisename;
    }

    /**
     * 
     * @return Array mit allen Reisetiteln
     * @author Maja Velickovic
     */
    public function getJourneyTitles() {
        $pdo = Database::connect();
        $statement = $pdo->query("SELECT reise_id, titel FROM reise order by beschreibung asc");
        $statement->execute();
        return $statement->fetchAll();
    }

}

?>