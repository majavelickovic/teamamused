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
    private $benutzernameRegisterError = null;
    private $vornameRegisterError = null;
    private $nachnameRegisterError = null;
    private $password1RegisterError = null;
    private $password2RegisterError = null;
    
    
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
                    $this->benutzernameRegisterError = 'Bitte einen registrierten Benutzernamen eingeben';
                    $this->valid = false;
                }
            }
            
            // Prüft das beim Login eingegebene Passwort
            if (empty($login->getPasswort())) {
                $this->passwordLoginError = 'Bitte ein Passwort eingeben';
                $this->valid = false;
            }

            // Prüft den beim Registrieren eingegebenen Benutzernamen
            if (empty($login->getBenutzername())) {
                $this->benutzernameRegisterError = 'Bitte einen Benutzernamen eingeben';
                $this->valid = false;
            } else {
                if (Service::getInstance()->uniqueBenutzername($login->getBenutzername())){ // Gibt true zurück, falls es den Benutzernamen bereits gibt
                    $this->benutzernameRegisterError = 'Bitte einen anderen Benutzernamen wählen - dieser ist bereits vergeben';
                    $this->valid = false;
                }
            }
  
            // Prüft den beim Registrieren eingegebenen Vornamen
            if (empty($login->getVorname())) {
                $this->vornameRegisterError = 'Bitte einen Vornamen eingeben';
                $this->valid = false;
            } else {
                // preg_match gibt 1 zurück, falls der String nur Buchstaben und Leerzeichen enthält
                if(1 !== preg_match('/^[a-zA-Z]+$/', $login->getVorname())){
                    $this->vornameRegisterError = 'Der Vorname darf nur Buchstaben enthalten';
                    $this->valid = false;
                }
            }

            // Prüft den beim Registrieren eingegebenen Nachnamen
            if (empty($login->getNachname())) {
                $this->nachnameRegisterError = 'Bitte einen Nachnamen eingeben';
                $this->valid = false;
            } else {
                // preg_match gibt 1 zurück, falls der String nur Buchstaben und Leerzeichen enthält
                if(1 !== preg_match('/^[a-zA-Z]+$/', $login->getNachname())){
                    $this->nachnameRegisterError = 'Der Nachname darf nur Buchstaben enthalten';
                    $this->valid = false;
                }
            }    
  
            // Prüft das beim Registrieren eingegebene Passwort
            if (empty($login->getPasswort())) {
                $this->password1RegisterError = 'Bitte ein Passwort eingeben';
                $this->valid = false;
            } else {
                // preg_match gibt 1 zurück, falls der String nur Buchstaben und Leerzeichen enthält
                if(1 === preg_match('/^[a-zA-Z]+$/', $login->getPasswort())){
                    $this->password1RegisterError = 'Das Passwort darf nicht nur aus Buchstaben bestehen';
                    $this->valid = false;
                }
            }
  
            // Prüft das beim Registrieren eingegebene bestätigte Passwort
            if (empty(($_POST["password2"]))) {
                $this->password2RegisterError = 'Bitte das Passwort bestätigen';
                $this->valid = false;
            } else {
                if ($login->getPasswort() !== testInput($_POST["password2"])){
                    $this->password2RegisterError = 'Das bestätigte Passwort stimmt nicht überein';
                    $this->valid = false;
                }
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
    
    public function isRegisterNameError()
    {
        return isset($this->benutzernameRegisterError);
    }

    public function getRegisterNameError()
    {
        return $this->benutzernameRegisterError;
    }
    
    public function isRegisterVornameError()
    {
        return isset($this->vornameRegisterError);
    }

    public function getRegisterVornameError()
    {
        return $this->vornameRegisterError;
    }

    public function isRegisterNachnameError()
    {
        return isset($this->nachnameRegisterError);
    }

    public function getRegisterNachnameError()
    {
        return $this->nachnameRegisterError;
    }    
    
    public function isRegisterPassword1Error()
    {
        return isset($this->password1RegisterError);
    }

    public function getRegisterPassword1Error()
    {
        return $this->password1RegisterError;
    }

    public function isRegisterPassword2Error()
    {
        return isset($this->password2RegisterError);
    }

    public function getRegisterPassword2Error()
    {
        return $this->password2RegisterError;
    }    
    
}
