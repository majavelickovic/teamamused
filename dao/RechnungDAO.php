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
use Exception;

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
	 * Liest alle Rechnungen gemäss Filterkriterien und gibt diese als eine Liste zurück, welche als Tabelle dargestellt wird
	 */
	public function read($_reise, $_rg_id, $_rgart) {
            $pdo = Database::connect();
            if($_reise != null && $_rg_id == null && $_rgart == null){
                $statement = $pdo->prepare(
                "SELECT rechnung.rg_id, reise_rechnung.reise_id, rechnungsart.beschreibung, rechnung.rechnungsart, rechnung.kosten
                   FROM rechnung INNER JOIN reise_rechnung ON rechnung.rg_id=reise_rechnung.rg_id INNER JOIN rechnungsart ON rechnung.rechnungsart = rechnungsart.rgart_id
                   WHERE reise_id = :reise_id ORDER BY :rg_id ASC;");
                $statement->bindValue(':reise_id', $_reise);
                $statement->execute();
            }elseif($_reise != null && $_rg_id != null && $_rgart == null){    
                 $statement = $pdo->prepare(
                 "SELECT rechnung.rg_id, reise_rechnung.reise_id, rechnungsart.beschreibung, rechnung.rechnungsart, rechnung.kosten
                   FROM rechnung INNER JOIN reise_rechnung ON rechnung.rg_id=reise_rechnung.rg_id INNER JOIN rechnungsart ON rechnung.rechnungsart = rechnungsart.rgart_id
                   WHERE reise_id = :reise_id and rechnung.rg_id = :rg_id ORDER BY :rg_id ASC;");
                 $statement->bindValue(':reise_id', $_reise);
                 $statement->bindValue(':rg_id', $_rg_id);
                 $statement->execute();
            }elseif($_reise != null && $_rg_id != null && $_rgart != null){
                $statement = $pdo->prepare(
                "SELECT rechnung.rg_id, reise_rechnung.reise_id, rechnungsart.beschreibung, rechnung.rechnungsart, rechnung.kosten
                   FROM rechnung INNER JOIN reise_rechnung ON rechnung.rg_id=reise_rechnung.rg_id INNER JOIN rechnungsart ON rechnung.rechnungsart = rechnungsart.rgart_id
                   WHERE reise_id = :reise_id and rechnung.rg_id = :rg_id and rechnungsart = :rgart ORDER BY :rg_id ASC;");
                $statement->bindValue(':reise_id', $_reise);
                $statement->bindValue(':rg_id', $_rg_id);
                $statement->bindValue(':rgart', $_rgart);
                $statement->execute();
            }elseif($_reise != null && $_rg_id == null && $_rgart != null){
                $statement = $pdo->prepare(
                "SELECT rechnung.rg_id, reise_rechnung.reise_id, rechnungsart.beschreibung, rechnung.rechnungsart, rechnung.kosten
                   FROM rechnung INNER JOIN reise_rechnung ON rechnung.rg_id=reise_rechnung.rg_id INNER JOIN rechnungsart ON rechnung.rechnungsart = rechnungsart.rgart_id
                   WHERE reise_id = :reise_id and rechnungsart = :rgart ORDER BY :rg_id ASC;");
                $statement->bindValue(':reise_id', $_reise);
                $statement->bindValue(':rgart', $_rgart);
                $statement->execute();
            }else{
                //nichts tun
            }
            
            if($statement != null){
                while ($row = $statement->fetch()){
                    $tableText .= "<tr>"
                            . "<td><a href=" . $GLOBALS["ROOT URL"] . "/rechnung/anzeige?id=" . $row['rg_id'] . ">" . $row["rg_id"] . "</a></td>"
                            . "<td>" . $row['reise_id'] . "</td>"
                            . "<td>" . $row["beschreibung"] . "</td>"
                            . "<td>" . $row["kosten"] . "</td>"
                            . "<td><a href=" . $GLOBALS["ROOT URL"] . "/rechnung/anzeige?id=" . $row['rg_id'] . "><img src='../design/pictures/search.png'></a></td>"
                            . "<td><a href='#' ><img src='../design/pictures/delete.png' onclick='deleteInvoice(" . $row['rg_id'] . ")'></a></td>"
                            . "</tr>";
                }
                return $tableText;
            }else{
                return " ";
            }

        }

	/**
	 * Aktualisiert ein Rechnungs-Objekt in der Tabelle "rechnung"
	 */
	public function update($rg_id, $reise, $rgart, $kosten, $beschreibung, $dokument) {
            $pdo = Database::connect();
            
            if($rgart != null){
                $statement1 = $pdo->prepare(
                    "UPDATE rechnung SET rechnungsart = :rechnungsart WHERE rg_id = :rg_id");
                $statement1->bindValue(':rg_id', $rg_id);
                $statement1->bindValue(':rechnungsart', $rgart);
                $statement1->execute();
            }
            
            if($kosten != null){
                $statement2 = $pdo->prepare(
                    "UPDATE rechnung SET kosten = :kosten WHERE rg_id = :rg_id");
                $statement2->bindValue(':rg_id', $rg_id);
                $statement2->bindValue(':kosten', $kosten);
                $statement2->execute();
            }
            
            if($beschreibung != null){
                $statement3 = $pdo->prepare(
                    "UPDATE rechnung SET beschreibung = :beschreibung WHERE rg_id = :rg_id");
                $statement3->bindValue(':rg_id', $rg_id);
                $statement3->bindValue(':beschreibung', $beschreibung);
                $statement3->execute();
            }
            
            if($dokument != null){
                $statement4 = $pdo->prepare(
                    "UPDATE rechnung SET dokument = :dokument WHERE rg_id = :rg_id");
                $statement4->bindValue(':rg_id', $rg_id);
                $statement->bindValue(':dokument', $dokument);
                $statement4->execute();
            }
       
            if($reise != null){
                $statement5 = $pdo->prepare(
                    "UPDATE reise_rechnung SET reise_id = :reise WHERE rg_id = :rg_id");
                $statement5->bindValue(':reise', $reise);
                $statement5->bindValue(':rg_id', $rg_id);
                $statement5->execute();
            }
          
	}

	/**
	 * Löscht ein Rechnungs-Objekt aus der Tabelle "rechnung" und "reise_rechnung"
	 */
	public function delete($rg_id) {
            $pdo = Database::connect();
            
            $statement1 = $pdo->prepare(
                "DELETE FROM reise_rechnung
                WHERE rg_id = :rg_id");
            $statement1->bindValue(':rg_id', $rg_id);
            $statement1->execute();
            
            $statement2 = $pdo->prepare(
                "DELETE FROM rechnung
                WHERE rg_id = :rg_id");
            $statement2->bindValue(':rg_id', $rg_id);
            $statement2->execute();


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
         * Datei für Rechnung raufladen (nur PDF erlaubt)
         */
        public function uploadInvoiceDoc(){
            //Erlaube MIME-Typen für Rechnungsupload
            $allowedMimeTypes = array( 
                'application/pdf'
            );

            $fileToUpload = $_FILES['dokument']["name"];

            //Prüfen, ob die Datei nicht zu gross ist
            if ( 20000000 < $_FILES['dokument']["size"]  ) {
              throw new Exception('Das PDF ist zu gross für den Upload.' );
            }

            //Prüfen, ob der MIME-Typ stimmt undn wenn ja, Upload auf Server
            if ( in_array( $_FILES['dokument']["type"], $allowedMimeTypes ) ) 
            {      
             move_uploaded_file($_FILES['dokument']["tmp_name"], "$home/uploads/invoice/" . $fileToUpload); 
            }
            else{
                throw new Exception('Bitte ein PDF raufladen, andere Typen nicht erlaubt.' . $_FILES['dokument']["type"]);
            }
         }


	/**
	 * Liest eine einzelne Rechnung aus der Datenbank, um diese dem Benutzer anzuzeigen
	 */
	public function readSingleInvoice($rg_id) {
            $pdo = Database::connect();           
            $statement = $pdo->prepare("SELECT rechnung.rg_id, reise_rechnung.reise_id, rechnung.rechnungsart, rechnung.kosten, rechnung.beschreibung, rechnung.dokument
                               FROM rechnung INNER JOIN reise_rechnung ON rechnung.rg_id=reise_rechnung.rg_id WHERE rechnung.rg_id = :rg_id;");
            $statement->bindValue(':rg_id', $rg_id);
            $statement->execute();
            $rg = new Rechnung();

            while ($row = $statement->fetch()){
                $rg->setReise($row['reise_id']);
                $rg->setRechnungsart($row['rechnungsart']);
                $rg->setKosten($row['kosten']);
                $rg->setBeschreibung($row['beschreibung']);
                $rg->setDokument($row['dokument']);
            }

            return $rg;
            
        }
        
         /**
	 * Liest die Daten für die Schlussabrechnung in einen Array und gibt diese zurück
	 */
	public function readFinalBilling($reise) {
            $array = array();
            $pdo = Database::connect();           
            $statement = $pdo->prepare("SELECT rechnung.kosten, rechnung.beschreibung AS b1, rechnungsart.beschreibung AS b2
                               FROM rechnung INNER JOIN reise_rechnung ON rechnung.rg_id=reise_rechnung.rg_id
                               INNER JOIN rechnungsart ON rechnung.rechnungsart = rechnungsart.rgart_id
                               WHERE reise_rechnung.reise_id = :reise;");
            $statement->bindValue(':reise', $reise);
            $statement->execute();

            while ($row = $statement->fetch()){
                array_push($array, array(
                    utf8_decode($row['b1'] . ' / ' . $row['b2']), 0-($row['kosten'])
                ));
            }
        
            $statement2 = $pdo->prepare("SELECT reise.preis, teilnehmer.vorname, teilnehmer.nachname FROM reise
                INNER JOIN reise_teilnehmer ON reise.reise_id=reise_teilnehmer.reise_id
                INNER JOIN teilnehmer ON reise_teilnehmer.teilnehmer_id = teilnehmer.teilnehmer_id
                WHERE reise.reise_id = :reise;");
            $statement2->bindValue(':reise', $reise);
            $statement2->execute();
            
            while ($row2 = $statement2->fetch()){
                array_push($array, array(
                    utf8_decode('Teilnahmekosten von ' . $row2['vorname'] . ' ' . $row2['nachname']), $row2['preis'])
                );
            }

            return $array;
            
        }
        
        /**
         * 
         * Liese die Rechnungsarten aus der Datenbank
         */
        public function getInvoiceTypes(){
            $pdo = Database::connect();           
            $statement = $pdo->prepare("SELECT * FROM rechnungsart order by beschreibung asc");
            $statement->execute();
            return $statement->fetchAll();
            }

}

?>