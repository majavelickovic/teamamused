<?php
/**
 * Controller für die Login- und Register-View
 */

namespace controller;

use view\view as View;
use service\Service;

class LoginController
{

    /*
     * Übernimmt die Angaben aus dem Registrierungsformular und gibt diese an die Service-Klasse weiter
     * Erhält aus der Service-Klasse einen Boolean zurück bei erfolgreichem Ändern/Hinzufügen eines Mitarbeiters
     */
    public static function register(){
        return Service::getInstance()->editLogin(
                $_POST["benutzername"],
                $_POST["password1"],
                $_POST["vorname"],
                $_POST["nachname"],
                "rolle"); // TODO: delete
    }
    
    public static function registerView(){
        echo (new View("register.php"))->render();
    }

    public static function loginView(){
        echo (new View("login.php"))->render();
    }
    
    public static function welcomeView() {
        echo (new View("welcome.php"))->render();
    }
    
}
?>