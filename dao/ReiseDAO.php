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
    public function read($_reise_id, $_titel, $_preis, $_startort) {
        $pdo = Database::connect();
        if ($_reise_id != null && $_titel == null && $_preis == null && $_startort == null) {
            $statement = $pdo->prepare(
                    "SELECT reise_id, titel, preis, startort
                   FROM reise
                   WHERE reise_id = :reise_id 
                   ORDER BY reise_id ASC;");
            $statement->bindValue(':reise_id', $_reise_id);
            $statement->execute();
        }
    }

    public function readSingleJourney($reise_id) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "SELECT reise_teilnehmer.reise_id, reise_rechnung.reise_id, reise.reise_id, reise.titel, reise.preis, reise.startort
                FROM reise INNER JOIN reise_teilnehmer ON reise.reise_id=reise_teilnehmer.reise_id INNER JOIN reise_rechnung ON reise.reise_id=reise_rechnung.reise_id 
                WHERE reise.reise_id = :reise_id;");
        $statement->bindValue(':reise_id', $reise_id);
        $statement->execute();
        $reise = new Reise();

        while ($row = $statement->fetch()) {
            $reise->setReise($row['reise_id']);
            $reise->setTitel($row['titel']);
            $reise->setPreis($row['preis']);
            $reise->setStartort($row['startort']);
        }
        return $reise;
    }

    /**
     * Aktualisiert ein Reise-Objekt in der Tabelle "reise"
     */
    public function update($reise_id, $titel, $beschreibung, $datum_start, $datum_ende, $preis, $max_teilnehmer, $startort) {
        $pdo = Database::connect();

        if ($titel != null) {
            $statement1 = $pdo->prepare(
                    "UPDATE reise SET titel = :titel WHERE reise_id = :reise_id");
            $statement1->bindValue(':reise_id', $reise_id);
            $statement1->bindValue(':titel', $titel);
            $statement1->execute();
        }

        if ($beschreibung != null) {
            $statement2 = $pdo->prepare(
                    "UPDATE reise SET beschreibung = :beschreibung WHERE reise_id = :reise_id");
            $statement2->bindValue(':reise_id', $reise_id);
            $statement2->bindValue(':beschreibung', $beschreibung);
            $statement2->execute();
        }

        if ($datum_start != null) {
            $statement3 = $pdo->prepare(
                    "UPDATE reise SET datum_start = :datum_start WHERE reise_id = :reise_id");
            $statement3->bindValue(':reise_id', $reise_id);
            $statement3->bindValue(':datum_start', $datum_start);
            $statement3->execute();
        }

        if ($datum_ende != null) {
            $statement4 = $pdo->prepare(
                    "UPDATE reise SET datum_ende = :datum_ende WHERE reise_id = :reise_id");
            $statement4->bindValue(':reise_id', $reise_id);
            $statement4->bindValue(':datum_ende', $datum_ende);
            $statement4->execute();
        }

        if ($preis != null) {
            $statement5 = $pdo->prepare(
                    "UPDATE reise SET preis = :preis WHERE reise_id = :reise_id");
            $statement5->bindValue(':reise_id', $reise_id);
            $statement5->bindValue(':preis', $preis);
            $statement5->execute();
        }

        if ($max_teilnehmer != null) {
            $statement6 = $pdo->prepare(
                    "UPDATE reise SET max_teilnehmer = :max_teilnehmer WHERE reise_id = :reise_id");
            $statement6->bindValue(':reise_id', $reise_id);
            $statement6->bindValue(':max_teilnehmer', $max_teilnehmer);
            $statement6->execute();
        }

        if ($startort != null) {
            $statement6 = $pdo->prepare(
                    "UPDATE reise SET startort = :startort WHERE reise_id = :reise_id");
            $statement6->bindValue(':reise_id', $reise_id);
            $statement6->bindValue(':startort', $startort);
            $statement6->execute();
        }
    }

    /**
     * Löscht ein Reise-Objekt aus der Tabelle "reise"
     */
    public function delete($reise_id) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "DELETE FROM reise
            WHERE reise_id = :reise_id");
        $statement->bindValue(':reise_id', $reise_id);
        $statement->execute();

        $statement2 = $pdo->prepare(
                "DELETE FROM reise_rechnung
                WHERE reise_id = :reise_id");
        $statement2->bindValue(':reise_id', $reise_id);
        $statement2->execute();

        $statement3 = $pdo->prepare(
                "DELETE FROM reise_teilnehmer
                WHERE reise_id = :reise_id");
        $statement3->bindValue(':reise_id', $reise_id);
        $statement3->execute();
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