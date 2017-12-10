<?php
/**
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Die Klasse stellt ein Data Access Object für die Domain Login (also die registrierten Mitarbeiter) dar
 * und bietet alle CRUD-Operatoren als Prepared Statement an.
 * 
 */

namespace dao;

use database\Database;
use domain\Login;

class LoginDAO {

	/**
	 * Erstellt einen registrierten Mitarbeiter in der DB-Tabelle "login"
	 */
	public function create(Login $login) {
            $pdo = Database::connect();
            $statement = $pdo->prepare(
                    "INSERT INTO login (benutzername, passwort, vorname, nachname)
                        VALUES (:benutzername, :passwort, :vorname, :nachname)");
            $statement->bindValue(':benutzername', $login->getBenutzername());
            $statement->bindValue(':passwort', $login->getPasswort());
            $statement->bindValue(':vorname', $login->getVorname());
            $statement->bindValue(':nachname', $login->getNachname());
            return $statement->execute();
	}

	/**
	 * Liest einen registrierten Mitarbeiter anhand des Benutzernamens aus der DB-Tabelle "login"
         * und gibt den entsprechenden Datensatz zurück
	 */
	public function read($benutzername) {
            $pdo = Database::connect();
            $statement = $pdo->prepare(
                "SELECT * FROM login WHERE benutzername = :benutzername;");
            $statement->bindValue(':benutzername', $benutzername);
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_CLASS, "Login")[0];
	}

	/**
	 * Aktualisiert einen registrierten Mitarbeiter in der DB-Tabelle "login"
         * und gibt den geänderten Datensatz zurück
	 */
	public function update(Login $login) {
            $pdo = Database::connect();
            $statement = $pdo->prepare(
                "UPDATE login SET benutzername = :benutzername, passwort = :passwort, vorname = :vorname, nachname = :nachname
                WHERE benutzername = :benutzername");
            $statement->bindValue(':benutzername', $login->getBenutzername());
            $statement->bindValue(':passwort', $login->getPasswort());
            $statement->bindValue(':vorname', $login->getVorname());
            $statement->bindValue(':nachname', $login->getNachname());
            $statement->execute();
            return $this->read($login->getBenutzername());
	}

	/**
	 * Löscht einen registrierten Mitarbeiter aus der DB-Tabelle "login"
	 */
	public function delete(Login $login) {
            $pdo = Database::connect();
            $statement = $pdo->prepare(
                "DELETE FROM login
                WHERE benutzername = :benutzername");
            $statement->bindValue(':benutzername', $login->getBenutzername());
            $statement->execute();
	}

	/**
	 * Sucht in der DB  nach einem Mitarbeiter anhand dem Benutzernamen
         * und gibt diesen zurück, falls es den Benutzernamen gibt
	 */
	public function findByBenutzername($benutzername) {
            $pdo = Database::connect();
            $statement = $pdo->prepare(
                "SELECT * FROM login WHERE benutzername = :benutzername");
            $statement->bindValue(':benutzername', $benutzername);
            $statement->execute();
            $res = $statement->fetchAll();
            if(isset($res[0])) {
                $login = new Login();
                $login->setBenutzername($res[0]['benutzername']);
                $login->setVorname($res[0]['vorname']);
                $login->setNachname($res[0]['nachname']);
                $login->setPasswort($res[0]['passwort']);
                return $login;
            } else {
                echo("Unbekannter Benutzername");
            }
        }
        
        /**
         * Sucht in der DB nach einem einem übergebenen Benutzernamen
         * und gibt den entsprechenden Boolean zurück         * 
         */
        public function findBenutzername($benutzername){
            $pdo = Database::connect();
            $statement = $pdo->prepare(
                "SELECT * FROM login WHERE benutzername = :benutzername");
            $statement->bindValue(':benutzername', $benutzername);
            $statement->execute();
            if(isset($statement->fetchAll()[0])) {
                return true;
            } else {
                return false;
            }
        }

}
?>