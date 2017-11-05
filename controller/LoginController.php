<?php
/**
 * Controller für die Login- und Register-View
 */

namespace controller;

use view\View;

class LoginController
{

    /*
     * Übernimmt die Angaben aus dem Registrierungsformular und gibt diese an die Service-Klasse weiter
     */
    public static function register(){
        \Service::getInstance()->editLogin(
                $_POST["userId"],
                $_POST["benutzername"],
                $_POST["passwort"],
                $_POST["vorname"],
                $_POST["nachname"],
                $_POST["rolle"]);
    }

    public static function registerView(){
        echo (new View("register.php"))->render();
    }

    public static function loginView(){
        echo (new View("login.php"))->render();
    }
}
?>