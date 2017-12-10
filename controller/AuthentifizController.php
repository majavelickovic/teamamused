<?php
/**
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Der Controller stellt Methoden für die Arbeit Sessions bereit
 * 
 */

namespace controller;

use service\Service;

class AuthentifizController
{
    
    /*
     * Setzt die Session-Variable, falls der User nach dem Abgleich mit der DB verifiziert werden konnte
     */
    public static function login(){
        if(Service::getInstance()->verifyUser($_POST['benutzername'],$_POST['password']))
        {
            $_SESSION['login'] = true;
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

}