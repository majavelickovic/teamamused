<?php
/**
 * TODO
 */

namespace controller;

use service\Service;

class AuthentifizController
{
    /*
     * Überprüft, ob die Session-Variable gesetzt ist und validiert das Token
     */
    public static function authenticate(){
        if (isset($_SESSION['login'])) {
//            if(Service::getInstance()->validateToken($_SESSION['login']['token'])) {
                return true;
//            }
        }
        return false;
    }

    public static function login(){
        if(Service::getInstance()->verifyUser($_POST['benutzername'],$_POST['password']))
        {
            $_SESSION['logn'] = "eingeloggt";
        }
    }
    
    public static function logout(){
        
        // Session wird zerstört
        session_destroy();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
    }

}