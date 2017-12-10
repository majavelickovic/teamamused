<?php
/**
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Der Controller stellt Methoden für die Arbeit Sessions bereit
 * 
 */

namespace controller;

use service\Service;
use domain\Login;
use validator\LoginValidator;
use view\View;

class AuthentifizController
{
    
    /*
     * Setzt die Session-Variable, falls die Eingaben des Users valide sind
     * und der User nach dem Abgleich mit der DB verifiziert werden konnte
     */
    public static function login(){
        $login = new Login(); // Objekt wird als Datenhaltung zur Validierung verwendet
        @$login->setBenutzername(AuthentifizController::testInput($_POST['benutzername']));
        @$login->setPasswort(AuthentifizController::testInput($_POST['password']));
        $loginValidator = new LoginValidator($login); // validiert implizit im Konstruktor das übergebene Objekt
        if($loginValidator->isValid()) {
            if(Service::getInstance()->verifyUser($login->getBenutzername(), $login->getPasswort())) {
                $_SESSION['login'] = true;
            }
        } else {
            $view = new View("login.php");
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
    
    // Überprüft übergebene Daten, um Cross-Site-Scripting zu verhindern
    public static function testInput($data){
        $data = trim($data); // entfernt Whitespace
        $data = stripslashes($data); // entfernt Anführungszeichen
        $data = htmlspecialchars($data); // entfernt html-Tags
        return $data;
    }

}