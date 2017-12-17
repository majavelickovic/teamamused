<?php
/**
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Der Controller zum Einstieg in die Webapplikation
 * 
 */

namespace controller;

use view\view as View;
use service\Service;
use domain\Login;
use validator\RegisterValidator;

class LoginController
{

    /*
     * Übernimmt die Angaben aus dem Registrierungsformular und gibt diese an die Service-Klasse weiter
     * Erhält aus der Service-Klasse einen Boolean zurück bei erfolgreichem Ändern/Hinzufügen eines Mitarbeiters
     */
    public static function register(){
        $benutzername = LoginController::testInput($_POST['benutzername']);
        $password = LoginController::testInput($_POST['password1']);
        $vorname = LoginController::testInput($_POST['vorname']);
        $nachname = LoginController::testInput($_POST['nachname']);

        $login = new Login(); // Objekt wird als Datenhaltung zur Validierug verwendet
        $login->setBenutzername($benutzername);
        $login->setPasswort($password);
        $login->setVorname($vorname);
        $login->setNachname($nachname);

        $loginValidator = new RegisterValidator($login); // validiert implizit im Konstruktor das übergebene Objekt
        if($loginValidator->isValid()) {
            Service::getInstance()->editLogin(
                $login->getBenutzername(),
                $login->getPasswort(),
                $login->getVorname(),
                $login->getNachname()
            );
            return true;
        } else {
            $view = new View("register.php");
            $view->login = $login; // schreibt bereits eingegebene Werte in das Formular, so dass diese nicht erneut eingegeben werden müssen
            $view->loginValidator = $loginValidator;
            echo $view->render();
            exit();
        }
        
    }
    
    /*
     * Setzt die Session-Variable, falls die Eingaben des Users valide sind
     * und der User nach dem Abgleich mit der DB verifiziert werden konnte
     */
    public static function login(){
        $benutzername = LoginController::testInput($_POST['benutzername']);
        $passwort = LoginController::testInput($_POST['password']);
        
        $login = new Login(); // Objekt wird als Datenhaltung zur Validierung verwendet
        $login->setBenutzername($benutzername);
        $login->setPasswort($passwort);
        $loginValidator = new LoginValidator($login); // validiert implizit im Konstruktor das übergebene Objekt
        if($loginValidator->isValid()) {
            if(Service::getInstance()->verifyUser($login->getBenutzername(), $login->getPasswort())) {
                $_SESSION['login'] = true;
            }
        } else {
            $view = new view("login.php");
            $view->login = $login; // schreibt bereits eingegebene Werte in das Formular, so dass diese nicht erneut eingegeben werden müssen
            $view->loginValidator = $loginValidator;
            echo $view->render();
            exit();
        }
    }
    
    /*
     * Überprüft, ob die Session-Variable gesetzt ist
     */
    public static function authenticate(){
        if (isset($_SESSION['login'])) {
                return true;
        }
        return false;
    }
   
    /*
     * Zerstört die Session beim Logout
     */
    public static function logout(){
        
        // von www.php.net
        // Mit der Löschung des Session-Cokkie wird die Session gelöscht und nicht nur die Session-Daten
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        
        // Session wird gelöscht
        session_destroy();
    }
    
    public static function registerView(){
        echo (new View("register.php"))->render();
    }

    public static function loginView(){
        echo (new View("login.php"))->render();
    }
    
    // Überprüft übergebene Daten, um Cross-Site-Scripting zu verhindern
    public static function testInput($data){
        $data = trim($data); // entfernt Whitespace
        $data = stripslashes($data); // entfernt Anführungszeichen
        $data = htmlspecialchars($data); // entfernt html-Tags
        return $data;
    }
    
}
?>