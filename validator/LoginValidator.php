<?php
/**
 * @author Michelle Widmer (angelehnt an Andreas Martin)
 * 
 * Der Validator überprüft serverseitig die Formulareingaben der Login- und der Register-Seite
 * 
 */

namespace validator;

use domain\Login;
use service\Service;

/**
 * Description of LoginValidator
 *
 * @author Michelle
 */
class LoginValidator {
    
    private $valid = true;
    private $benutzernameLoginError = null;
    private $passwordLoginError = null;
    
    
    /*
     * Konstruktor ruft sofort die Validierungsmethode für das übergebene Objekt auf
     */
    public function __construct(Login $login)
    {
        $this->validate($login);
    }
    
    /*
     * Validiert das übergebene Login-Objekt (Daten aus Login- und Register-Formular)
     * und setzt entsprechend die valid-Variable
     */
    public function validate(Login $login) {
        if (!is_null($login)) {
            // Prüft den beim Login eingegebenen Benutzernamen
            if (empty($login->getBenutzername())) {
                $this->benutzernameLoginError = 'Bitte einen Benutzernamen eingeben';
                $this->valid = false;
            } else {
                if (!Service::getInstance()->uniqueBenutzername($login->getBenutzername())){ // Gibt true zurück, falls es den Benutzernamen bereits gibt
                    $this->benutzernameLoginError = 'Bitte einen registrierten Benutzernamen eingeben';
                    $this->valid = false;
                }
            }
            
            // Prüft das beim Login eingegebene Passwort
            if (empty($login->getPasswort())) {
                $this->passwordLoginError = 'Bitte ein Passwort eingeben';
                $this->valid = false;
            }
              
        } else {
            $this->valid = false;
        }
        return $this->valid;
    }

    /*
     * Gibt zurück, ob geprüfte Objekt valide ist
     */
    public function isValid()
    {
        return $this->valid;
    }

    public function isLoginNameError()
    {
        return isset($this->benutzernameLoginError);
    }

    public function getLoginNameError()
    {
        return $this->benutzernameLoginError;
    }

    public function isLoginPasswordError()
    {
        return isset($this->passwordLoginError);
    }

    public function getLoginPasswordError()
    {
        return $this->passwordLoginError;
    }
    
}
