<?php
/**
 * @access public
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Die Klasse stellt ein Data Access Object für die Klasse Login (also die registriertne Mitarbeiter) dar und bietet alle CRUD-Operatoren als Prepared Statement an.
 * 
 */

namespace dao;

use database\Database;
use domain\Login;
use domain\Rolle;

class LoginDAO {

	/**
	 * Erstellt einen registrierten Mitarbeiter in der Tabelle "login"
	 */
	public function create(Login $login) {
            $pdo = Database::connect();
            $statement = $pdo->prepare(
                    "INSERT INTO login (userid, benutzername, passwort, vorname, nachname, rolle)
                        VALUES (:userid, :benutzername, :passwort, :vorname, :nachname, 1)");
            $statement->bindValue(':userid', $login->getUserId());
            $statement->bindValue(':benutzername', $login->getBenutzername());
            $statement->bindValue(':passwort', $login->getPasswort());
            $statement->bindValue(':vorname', $login->getVorname());
            $statement->bindValue(':nachname', $login->getNachname());
            return $statement->execute();
//        return $this->read($pdo->lastInsertId());
	}

	/**
	 * Liest einen registrierten Mitarbeiter aus der Tabelle "login"
	 */
	public function read($userid) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
            "SELECT * FROM login WHERE userid = :userid;");
        $statement->bindValue(':userid', $userid);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, "Login")[0];
	}

	/**
	 * Aktualisiert einen registrierten Mitarbeiter in der Tabelle "login"
	 */
	public function update(Login $login) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
            "UPDATE login SET benutzername = :benutzername, passwort = :passwort, vorname = :vorname, nachname = :nachname, rolle = 1
            WHERE userid = :userid");
        $statement->bindValue(':userid', $login->getUserId());
        $statement->bindValue(':benutzername', $login->getBenutzername());
        $statement->bindValue(':passwort', $login->getPasswort());
        $statement->bindValue(':vorname', $login->getVorname());
        $statement->bindValue(':nachname', $login->getNachname());
        $statement->execute();
        return $this->read($login->getUserId());
	}

	/**
	 * Löscht einen registrierten Mitarbeiter aus der Tabelle "login"
	 */
	public function delete(Login $login) {
        $pdo = Database::connect();
        $statement = $pdo->prepare(
            "DELETE FROM login
            WHERE userid = :userid");
        $statement->bindValue(':userid', $login->getUserId());
        $statement->execute();
	}

	/**
	 * noch überarbeiten
	 */
	public function findByUserId($userid) {
            $pdo = Database::connect();
            $statement = $pdo->prepare(
                "SELECT * FROM login WHERE userid = :userid");
            $statement->bindValue(':userid', $userid);
            $statement->execute();
            return $statement->fetchAll()[0];
//            return $statement->fetchAll(\PDO::FETCH_CLASS, "domain\Login")[0];
        }

}
?>