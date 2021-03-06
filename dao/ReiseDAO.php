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
        $statement->bindValue(':startort', $reise->getOrt_id());
        $statement->execute();
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
        } elseif ($_reise_id != null && $_titel != null && $_preis == null && $_startort == null) {
            $statement = $pdo->prepare(
                    "SELECT reise_id, titel, preis, startort
                   FROM reise
                   WHERE reise_id = :reise_id and titel = :titel
                   ORDER BY reise_id ASC;");
            $statement->bindValue(':reise_id', $_reise_id);
            $statement->bindValue(':titel', $_titel);
            $statement->execute();
        } elseif ($_reise_id != null && $_titel != null && $_preis != null && $_startort == null) {
            $statement = $pdo->prepare(
                    "SELECT reise_id, titel, preis, startort
                   FROM reise
                   WHERE reise_id = :reise_id and titel = :titel and preis = :preis
                   ORDER BY reise_id ASC;");
            $statement->bindValue(':reise_id', $_reise_id);
            $statement->bindValue(':titel', $_titel);
            $statement->bindValue(':preis', $_preis);
            $statement->execute();
        } elseif ($_reise_id != null && $_titel != null && $_preis != null && $_startort != null) {
            $statement = $pdo->prepare(
                    "SELECT reise_id, titel, preis, startort
                   FROM reise
                   WHERE reise_id = :reise_id and titel = :titel and preis = :preis and startort = :startort
                   ORDER BY reise_id ASC;");
            $statement->bindValue(':reise_id', $_reise_id);
            $statement->bindValue(':titel', $_titel);
            $statement->bindValue(':preis', $_preis);
            $statement->bindValue(':startort', $_startort);
            $statement->execute();
        } elseif ($_reise_id == null && $_titel != null && $_preis == null && $_startort == null) {
            $statement = $pdo->prepare(
                    "SELECT reise_id, titel, preis, startort
                   FROM reise
                   WHERE titel = :titel
                   ORDER BY reise_id ASC;");
            $statement->bindValue(':titel', $_titel);
            $statement->execute();
        } elseif ($_reise_id == null && $_titel == null && $_preis != null && $_startort == null) {
            $statement = $pdo->prepare(
                    "SELECT reise_id, titel, preis, startort
                   FROM reise
                   WHERE preis = :preis 
                   ORDER BY reise_id ASC;");
            $statement->bindValue(':preis', $_preis);
            $statement->execute();
        } elseif ($_reise_id == null && $_titel != null && $_preis == null && $_startort != null) {
            $statement = $pdo->prepare(
                    "SELECT reise_id, titel, preis, startort
                   FROM reise
                   WHERE titel = :titel and startort = :startort
                   ORDER BY reise_id ASC;");
            $statement->bindValue(':titel', $_titel);
            $statement->bindValue(':startort', $_startort);
            $statement->execute();
        } elseif ($_reise_id == null && $_titel == null && $_preis == null && $_startort != null) {
            $statement = $pdo->prepare(
                    "SELECT reise_id, titel, preis, startort
                   FROM reise
                   WHERE startort = :startort
                   ORDER BY reise_id ASC;");
            $statement->bindValue(':startort', $_startort);
            $statement->execute();
        } else {
            //nichts tun
        }
        if ($statement != null) {
            $tableText = "";
            while ($row = $statement->fetch()) {
                $tableText .= "<tr>"
                        . "<td><a href=" . $GLOBALS["ROOT URL"] . "/reise/anzeige?id=" . $row['reise_id'] . ">" . $row["reise_id"] . "</a></td>"
                        . "<td>" . $row["titel"] . "</td>"
                        . "<td><a href=" . $GLOBALS["ROOT URL"] . "/reise/anzeige?id=" . $row['reise_id'] . "><img src='../design/pictures/search.png'></a></td>"
                        . "<td><a href='#' ><img src='../design/pictures/delete.png' onclick='deleteJourney(" . $row['reise_id'] . ")'></a></td>"
                        . "</tr>";
            }
            return $tableText;
        } else {
            return " ";
        }
    }

    /**
     * Prüfe maximale Teilnehmeranzahl für Reise und gib true zurück, wenn Teilnehmerzahl erreicht
     * @param type $reise
     */
    public function checkMaxParticipantForJourney($reise) {
        if ($reise != null) {
            $pdo = Database::connect();

            $statement1 = $pdo->prepare(
                    "SELECT max_teilnehmer FROM reise WHERE reise_id = :reise;");
            $statement1->bindValue(':reise', $reise);
            $statement1->execute();
            while ($row = $statement1->fetch()) {
                $maxTeilnehmerReise = $row['max_teilnehmer'];
            }

            $statement2 = $pdo->prepare(
                    "SELECT COUNT(*) FROM reise_teilnehmer WHERE reise_id = :reise;");
            $statement2->bindValue(':reise', $reise);
            $statement2->execute();
            while ($row2 = $statement2->fetch()) {
                $countTeilnehmerReise = $row2['COUNT'];
            }

            if ($countTeilnehmerReise >= $maxTeilnehmerReise) {
                return "true";
            } else {
                return "false";
            }
        }
    }

    /**
     * Liest die Rechnungen für eine Reise und gibt diese aus in der Reiseansicht
     */
    public function readRechnungen($reise_id) {
        $pdo = Database::connect();
        if ($reise_id != null) {
            $statement = $pdo->prepare(
                    "SELECT rechnung.rg_id, rechnungsart.beschreibung, kosten FROM public.rechnung
                        INNER JOIN rechnungsart ON rechnung.rechnungsart = rechnungsart.rgart_id
                        INNER JOIN reise_rechnung ON rechnung.rg_id = reise_rechnung.rg_id
                         WHERE reise_id = :reise_id 
                         ORDER BY rechnung.rg_id ASC;");
            $statement->bindValue(':reise_id', $reise_id);
            $statement->execute();
        } else {
            //nichts tun
        }
        if ($statement != null) {
            $tableText = "";
            while ($row = $statement->fetch()) {
                $tableText .= "<tr>"
                        . "<td></td>"
                        . "<td>" . $row["rg_id"] . "</td>"
                        . "<td>" . $row["beschreibung"] . "</td>"
                        . "<td>" . $row["kosten"] . "</td>"
                        . "<td><a href=" . $GLOBALS["ROOT URL"] . "/rechnung/anzeige?id=" . $row['rg_id'] . "><img src='../design/pictures/search.png'></a></td>"
                        . "</tr>";
            }
            return $tableText;
        } else {
            return " ";
        }
    }

    /**
     * Liest die Teilnehmer für eine Reise und gibt diese aus in der Reiseansicht
     */
    public function readTeilnehmer($reise_id) {
        $pdo = Database::connect();
        if ($reise_id != null) {
            $statement = $pdo->prepare(
                    "SELECT vorname, nachname, teilnehmer.teilnehmer_id FROM public.teilnehmer
                        INNER JOIN reise_teilnehmer ON teilnehmer.teilnehmer_id = reise_teilnehmer.teilnehmer_id
                         WHERE reise_id = :reise_id 
                         ORDER BY teilnehmer.teilnehmer_id ASC;");
            $statement->bindValue(':reise_id', $reise_id);
            $statement->execute();
        } else {
            //nichts tun
        }
        if ($statement != null) {
            $tableText = "";
            while ($row = $statement->fetch()) {
                $tableText .= "<tr>"
                        . "<td></td>"
                        . "<td>" . $row["vorname"] . "</td>"
                        . "<td>" . $row["nachname"] . "</td>"
                        . "<td><a href=" . $GLOBALS["ROOT URL"] . "/teilnehmer/anzeige?id=" . $row['teilnehmer_id'] . "><img src='../design/pictures/search.png'></a></td>"
                        . "</tr>";
            }
            return $tableText;
        } else {
            return " ";
        }
    }

    /**
     * Liest eine einzelne Reise aus der Datenbank, um diese dem Benutzer anzuzeigen
     */
    public function readSingleJourney($reise_id) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
                "SELECT * FROM reise WHERE reise_id = :reise_id;");
        $statement->bindValue(':reise_id', $reise_id);
        $statement->execute();
        $reise = new Reise();

        while ($row = $statement->fetch()) {
            $reise->setReise_id($reise_id);
            $reise->setTitel($row['titel']);
            $reise->setBeschreibung($row['beschreibung']);
            $reise->setDatum_start($row['datum_start']);
            $reise->setDatum_ende($row['datum_ende']);
            $reise->setPreis($row['preis']);
            $reise->setMax_teilnehmer($row['max_teilnehmer']);
            $reise->setOrt_id($row['startort']);
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
     * Lese die letzte Reisenummer und gib +1 zurück für neue Reise-ID
     */
    public function getNewReiseID() {
        $pdo = Database::connect();
        $statement = $pdo->query(
                "SELECT reise_id FROM reise
                ORDER BY reise_id DESC LIMIT 1");
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $returnvalue = $row["reise_id"];
        }
        if ($returnvalue == "") {
            return 1;
        } else {
            return $returnvalue + 1;
        }
    }

    /**
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
     * @return Array mit allen Standorten
     * @author Sandra Bodack
     */
    public function getPlaces() {
        $pdo = Database::connect();
        $statement = $pdo->query("SELECT * FROM ort;");
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
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
