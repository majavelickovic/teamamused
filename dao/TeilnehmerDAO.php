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
        $statement->bindValue(':geburtsdatum', $teilnehmer->getGeburtsdatum());
        $statement->execute();

        $statement2 = $pdo->prepare(
                "INSERT INTO reise_teilnehmer (reise_id, teilnehmer_id)
                        VALUES (:reise, :teilnehmer_id)");
        $statement2->bindValue(':reise', $teilnehmer->getReise());
        $statement2->bindValue(':teilnehmer_id', $teilnehmer->getTeilnehmer_id());
        $statement2->execute();
    }

    /**
     * Sucht nach Teilnehmern welche den Kriterien entsprechen aus der Tabelle "teilnehmer
     */
    public function read($_reise, $_teilnehmer_id, $_vorname, $_nachname) {
        $pdo = Database::connect();
        if (!isset($_reise) OR empty($_reise)) {
            $_reise = 0;
        }
        if (!isset($_teilnehmer_id) OR empty($_teilnehmer_id)) {
            $_teilnehmer_id = 0;
        }
        if (!isset($_vorname) OR empty($_vorname)) {
            $_vorname = "qq";
        }
        if (!isset($_nachname) OR empty($_nachname)) {
            $_nachname = "qq";
        }
        $statement = $pdo->prepare(
                "SELECT teilnehmer.teilnehmer_id, vorname, nachname, reise_id 
                    FROM teilnehmer 
                    INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id = reise_teilnehmer.teilnehmer_id 
                    WHERE teilnehmer.teilnehmer_id = :teilnehmer_id OR vorname like :vorname OR nachname like :nachname OR reise_id like :reise_id;");
        $statement->bindValue(':reise_id', $_reise);
        $statement->bindValue(':teilnehmer_id', $_teilnehmer_id);
        $statement->bindValue(':vorname', $_vorname);
        $statement->bindValue(':nachname', $_nachname);
        $statement->execute();

        $tableText = "";
        while ($row = $statement->fetch()) {
            $tableText .= "<tr>"
                    . "<td><a href=" . $GLOBALS["ROOT URL"] . "/teilnehmer/anzeige?id=" . $row['teilnehmer_id'] . ">" . $row["teilnehmer_id"] . "</a></td>"
                    . "<td>" . $row['reise_id'] . "</td>"
                    . "<td>" . $row["vorname"] . "</td>"
                    . "<td>" . $row["nachname"] . "</td>"
                    . "<td><a href=" . $GLOBALS["ROOT URL"] . "/teilnehmer/anzeige?id=" . $row['teilnehmer_id'] . "><img src='../design/pictures/search.png'></a></td>"
                    . "<td><a href='#' ><img src='../design/pictures/delete.png' onclick='deleteInvoice(" . $row['teilnehmer_id'] . ")'></a></td>"
                    . "</tr>";
        }
        if ($tableText == "") {
            return "Nichts gefunden!";
        }
        return $tableText;
    }

    /**
     * Liest ein Teilnehmer-Objekt aus der Tabelle "teilnehmer
     */
//    public function readSingeParticipant($teilnehmer_id) {
//        $pdo = Database::connect();
//        $statement = $pdo->prepare(
//                "SELECT * FROM teilnehmer WHERE teilnehmer_id = :teilnehmer_id;");
//        $statement->bindValue(':teilnehmer_id', $_teilnehmer_id);
//        $statement->execute();
//        return $statement->fetchAll(\PDO::FETCH_CLASS, "Teilnehmer")[0];
//    }

    public function readSingeParticipant($teilnehmer_id) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "SELECT reise_teilnehmer.reise_id, teilnehmer.teilnehmer_id, teilnehmer.vorname, teilnehmer.nachname, teilnehmer.geburtsdatum
                FROM teilnehmer INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id=reise_teilnehmer.teilnehmer_id 
                WHERE teilnehmer.teilnehmer_id = :teilnehmer_id;");
        $statement->bindValue(':teilnehmer_id', $teilnehmer_id);
        $statement->execute();
        $teilnehmer = new Teilnehmer();

        while ($row = $statement->fetch()) {
            $teilnehmer->setReise($row['reise_id']);
            $teilnehmer->setVorname($row['vorname']);
            $teilnehmer->setNachname($row['nachname']);
            $teilnehmer->setGeburtsdatum($row['geburtsdatum']);
        }

        return $teilnehmer;
    }

    /**
     * Aktualisiert ein Teilnehmer-Objekt in der Tabelle "teilnehmer"
     */
    public function update(Teilnehmer $teilnehmer) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "UPDATE teilnehmer SET vorname = :vorname, nachname = :nachname, geburtsdatum = :geburtsdatum
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
        $statement->bindValue(':teilnehmer_id', $teilnehmer->getTeilnehmer_id());
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