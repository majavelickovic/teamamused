<?php

/**
 * @access public
 * @author Sandra Bodack, Michelle Widmer (angelehnt an Andreas Martin)
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
        if ($_reise != null && $_teilnehmer_id == null && $_vorname == null && $_nachname == null) {
            $statement = $pdo->prepare(
                    "SELECT teilnehmer.teilnehmer_id, reise_teilnehmer.reise_id, teilnehmer.vorname, teilnehmer.nachname
                   FROM teilnehmer
                   INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id=reise_teilnehmer.teilnehmer_id
                   WHERE reise_id = :reise_id 
                   ORDER BY teilnehmer.teilnehmer_id ASC;");
            $statement->bindValue(':reise_id', $_reise);
            $statement->execute();
        } elseif ($_reise != null && $_teilnehmer_id != null && $_vorname == null && $_nachname == null) {
            $statement = $pdo->prepare(
                    "SELECT teilnehmer.teilnehmer_id, reise_teilnehmer.reise_id, teilnehmer.vorname, teilnehmer.nachname
                   FROM teilnehmer 
                   INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id=reise_teilnehmer.teilnehmer_id 
                   WHERE reise_id = :reise_id and teilnehmer.teilnehmer_id = :teilnehmer_id 
                   ORDER BY teilnehmer.teilnehmer_id ASC;");
            $statement->bindValue(':reise_id', $_reise);
            $statement->bindValue(':teilnehmer_id', $_teilnehmer_id);
            $statement->execute();
        } elseif ($_reise == null && $_teilnehmer_id != null && $_vorname == null && $_nachname == null) {
            $statement = $pdo->prepare(
                    "SELECT teilnehmer.teilnehmer_id, reise_teilnehmer.reise_id, teilnehmer.vorname, teilnehmer.nachname
                   FROM teilnehmer 
                   INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id=reise_teilnehmer.teilnehmer_id 
                   WHERE teilnehmer.teilnehmer_id = :teilnehmer_id 
                   ORDER BY teilnehmer.teilnehmer_id ASC;");
            $statement->bindValue(':teilnehmer_id', $_teilnehmer_id);
            $statement->execute();
        } elseif ($_reise != null && $_teilnehmer_id != null && $_vorname != null && $_nachname == null) {
            $statement = $pdo->prepare(
                    "SELECT teilnehmer.teilnehmer_id, reise_teilnehmer.reise_id, teilnehmer.vorname, teilnehmer.nachname
                   FROM teilnehmer 
                   INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id=reise_teilnehmer.teilnehmer_id
                   WHERE reise_id = :reise_id and teilnehmer.teilnehmer_id = :teilnehmer_id and teilnehmer.vorname = :vorname 
                   ORDER BY teilnehmer.teilnehmer_id ASC;");
            $statement->bindValue(':reise_id', $_reise);
            $statement->bindValue(':teilnehmer_id', $_teilnehmer_id);
            $statement->bindValue(':vorname', $_vorname);
            $statement->execute();
        } elseif ($_reise != null && $_teilnehmer_id != null && $_vorname != null && $_nachname != null) {
            $statement = $pdo->prepare(
                    "SELECT teilnehmer.teilnehmer_id, reise_teilnehmer.reise_id, teilnehmer.vorname, teilnehmer.nachname
                   FROM teilnehmer 
                   INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id=reise_teilnehmer.teilnehmer_id
                   WHERE reise_id = :reise_id and teilnehmer.teilnehmer_id = :teilnehmer_id and teilnehmer.vorname = :vorname and teilnehmer.nachname = :nachname
                   ORDER BY teilnehmer.teilnehmer_id ASC;");
            $statement->bindValue(':reise_id', $_reise);
            $statement->bindValue(':teilnehmer_id', $_teilnehmer_id);
            $statement->bindValue(':vorname', $_vorname);
            $statement->bindValue(':nachname', $_nachname);
            $statement->execute();
        } elseif ($_reise != null && $_teilnehmer_id == null && $_vorname != null && $_nachname == null) {
            $statement = $pdo->prepare(
                    "SELECT teilnehmer.teilnehmer_id, reise_teilnehmer.reise_id, teilnehmer.vorname, teilnehmer.nachname
                   FROM teilnehmer 
                   INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id=reise_teilnehmer.teilnehmer_id
                   WHERE reise_id = :reise_id and teilnehmer.vorname = :vorname 
                   ORDER BY teilnehmer.teilnehmer_id ASC;");
            $statement->bindValue(':reise_id', $_reise);
            $statement->bindValue(':vorname', $_vorname);
            $statement->execute();
        } elseif ($_reise == null && $_teilnehmer_id == null && $_vorname != null && $_nachname == null) {
            $statement = $pdo->prepare(
                    "SELECT teilnehmer.teilnehmer_id, reise_teilnehmer.reise_id, teilnehmer.vorname, teilnehmer.nachname
                   FROM teilnehmer 
                   INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id=reise_teilnehmer.teilnehmer_id
                   WHERE teilnehmer.vorname = :vorname 
                   ORDER BY teilnehmer.teilnehmer_id ASC;");
            $statement->bindValue(':vorname', $_vorname);
            $statement->execute();
        } elseif ($_reise == null && $_teilnehmer_id == null && $_vorname == null && $_nachname != null) {
            $statement = $pdo->prepare(
                    "SELECT teilnehmer.teilnehmer_id, reise_teilnehmer.reise_id, teilnehmer.vorname, teilnehmer.nachname
                   FROM teilnehmer 
                   INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id=reise_teilnehmer.teilnehmer_id
                   WHERE teilnehmer.nachname = :nachname 
                   ORDER BY teilnehmer.teilnehmer_id ASC;");
            $statement->bindValue(':nachname', $_nachname);
            $statement->execute();
        } elseif ($_reise != null && $_teilnehmer_id == null && $_vorname == null && $_nachname != null) {
            $statement = $pdo->prepare(
                    "SELECT teilnehmer.teilnehmer_id, reise_teilnehmer.reise_id, teilnehmer.vorname, teilnehmer.nachname
                   FROM teilnehmer 
                   INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id=reise_teilnehmer.teilnehmer_id
                   WHERE reise_id = :reise_id and teilnehmer.nachname = :nachname 
                   ORDER BY teilnehmer.teilnehmer_id ASC;");
            $statement->bindValue(':reise_id', $_reise);
            $statement->bindValue(':nachname', $_nachname);
            $statement->execute();
        } else {
            //nichts tun
        }
        if ($statement != null) {
            $tableText = "";
            while ($row = $statement->fetch()) {
                $tableText .= "<tr>"
                        . "<td><a href=" . $GLOBALS["ROOT URL"] . "/teilnehmer/anzeige?id=" . $row['teilnehmer_id'] . ">" . $row["teilnehmer_id"] . "</a></td>"
                        . "<td>" . $row['reise_id'] . "</td>"
                        . "<td>" . $row["vorname"] . "</td>"
                        . "<td>" . $row["nachname"] . "</td>"
                        . "<td><a href=" . $GLOBALS["ROOT URL"] . "/teilnehmer/anzeige?id=" . $row['teilnehmer_id'] . "><img src='../design/pictures/search.png'></a></td>"
                        . "<td><a href='#' ><img src='../design/pictures/delete.png' onclick='deleteParticipant(" . $row['teilnehmer_id'] . ")'></a></td>"
                        . "</tr>";
            }
            return $tableText;
        } else {
            return " ";
        }
    }

    /**
     * Liest ein Teilnehmer-Objekt aus der Tabelle "teilnehmer
     */
    public function readSingleParticipant($teilnehmer_id) {
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
    public function update($teilnehmer_id, $reise, $vorname, $nachname, $geburtsdatum) {
        $pdo = Database::connect();
        if ($reise != null) {
            $statement1 = $pdo->prepare(
                    "UPDATE reise_teilnehmer SET reise_id = :reise WHERE teilnehmer_id = :teilnehmer_id");
            $statement1->bindValue(':reise', $reise);
            $statement1->bindValue(':teilnehmer_id', $teilnehmer_id);
            $statement1->execute();
        }
        if ($vorname != null) {
            $statement2 = $pdo->prepare(
                    "UPDATE teilnehmer SET vorname = :vorname WHERE teilnehmer_id = :teilnehmer_id");
            $statement2->bindValue(':teilnehmer_id', $teilnehmer_id);
            $statement2->bindValue(':vorname', $vorname);
            $statement2->execute();
        }
        if ($nachname != null) {
            $statement3 = $pdo->prepare(
                    "UPDATE teilnehmer SET nachname = :nachname WHERE teilnehmer_id = :teilnehmer_id");
            $statement3->bindValue(':teilnehmer_id', $teilnehmer_id);
            $statement3->bindValue(':nachname', $nachname);
            $statement3->execute();
        }
        if ($geburtsdatum != null) {
            $statement4 = $pdo->prepare(
                    "UPDATE teilnehmer SET geburtsdatum = :geburtsdatum WHERE teilnehmer_id = :teilnehmer_id");
            $statement4->bindValue(':teilnehmer_id', $teilnehmer_id);
            $statement4->bindValue(':geburtsdatum', $geburtsdatum);
            $statement4->execute();
        }
    }

    /**
     * Löscht ein Teilnehmer-Objekt aus der Tabelle "teilnehmer"
     */
    public function delete($teilnehmer_id) {
        $pdo = Database::connect();
        $statement1 = $pdo->prepare(
                "DELETE FROM reise_teilnehmer
            WHERE teilnehmer_id = :teilnehmer_id");
        $statement1->bindValue(':teilnehmer_id', $teilnehmer_id);
        $statement1->execute();
        $statement2 = $pdo->prepare(
                "DELETE FROM teilnehmer
            WHERE teilnehmer_id = :teilnehmer_id");
        $statement2->bindValue(':teilnehmer_id', $teilnehmer_id);
        $statement2->execute();
    }

    public function getNewTeilnehmerID() {
        $pdo = Database::connect();
        $statement = $pdo->query(
                "SELECT teilnehmer_id FROM teilnehmer
                ORDER BY teilnehmer_id DESC LIMIT 1");
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $returnvalue = $row["teilnehmer_id"];
        }
        if($returnvalue == ""){
            return 1;
        }else{
            return $returnvalue + 1;
        }
    }

}

?>