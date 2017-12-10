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
use validator\LoginValidator;

class LoginController
{

    /*
     * Übernimmt die Angaben aus dem Registrierungsformular und gibt diese an die Service-Klasse weiter
     * Erhält aus der Service-Klasse einen Boolean zurück bei erfolgreichem Ändern/Hinzufügen eines Mitarbeiters
     */
    public static function register(){
                $login = new Login(); // Objekt wird als Datenhaltung zur Validierug verwendet
                @$login->setBenutzername(LoginController::testInput($_POST['benutzername']));
                @$login->setPasswort(LoginController::testInput($_POST['password1']));
                @$login->setPasswort(LoginController::testInput($_POST['vorname']));
                @$login->setPasswort(LoginController::testInput($_POST['nachname']));
                $loginValidator = new LoginValidator($login); // validiert implizit im Konstruktor das übergebene Objekt
                if($loginValidator->isValid()) {
                    Service::getInstance()->editLogin(
                        $login->getBenutzername(),
                        $login->getPasswort(),
                        $login->getVorname(),
                        $login->getNachname()
                    );
                } else {
                    $view = new View("register.php");
                    $view->login = $login; // schreibt bereits eingegebene Werte in das Formular, so dass diese nicht erneut eingegeben werden müssen
                    $view->loginValidator = $loginValidator;
                    echo $view->render();
                    exit();
        }
        
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
    
    // Überprüft übergebene Daten, um Cross-Site-Scripting zu verhindern
    public static function testInput($data){
        $data = trim($data); // entfernt Whitespace
        $data = stripslashes($data); // entfernt Anführungszeichen
        $data = htmlspecialchars($data); // entfernt html-Tags
        return $data;
    }
    
}
?>