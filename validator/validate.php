<?php

namespace validator;

use service\Service;

/*
 * Serverseitige Validierung von Formulareingaben
 */

// Validierung der Login-Seite bezüglich Vollständigkeit der Inputfelder
$benutzernameLoginError = "";
$passwordLoginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["benutzername"])) {
    $benutzernameLoginError = "Die Eingabe eines Benutzernamens ist erforderlich!";
  } 

  if (empty($_POST["password"])) {
    $passwordLoginError = "Die Eingabe eines Passwortes ist erforderlich!";
  }
}

// Validierung der Register-Seite bezüglich Vollständigkeit der Inputfelder
$benutzername = "";
$benutzernameRegisterError = "";
$vorname = "";
$vornameRegisterError = "";
$nachname = "";
$nachnameRegisterError = "";
$password1 = "";
$password1RegisterError = "";
$password2 = "";
$password2RegisterError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["benutzername"])) {
    $benutzernameRegisterError = "Die Eingabe eines Benutzernamens ist erforderlich!";
  } else {
    $benutzername = validateBenutzername($_POST["benutzername"]);
  }
  
  if (empty($_POST["vorname"])) {
    $vornameRegisterError = "Die Eingabe eines Vornamens ist erforderlich!";
  } else {
    $vorname = validateVorname($_POST["vorname"]);
  }  

  if (empty($_POST["nachname"])) {
    $nachnameRegisterError = "Die Eingabe eines Nachnamens ist erforderlich!";
  } else {
    $nachname = validateNachname($_POST["nachname"]);
  }    
  
  if (empty($_POST["password1"])) {
    $password1RegisterError = "Die Eingabe eines Passwortes ist erforderlich!";
  } else {
    $password1 = validatePassword1($_POST["password1"]);
  }
  
  if (empty($_POST["password2"])) {
    $password2RegisterError = "Die Bestätigung des Passwortes ist erforderlich!";
  } else {
    $password2 = validatePassword2($_POST["password2"]);
  }  
  
}

$benutzernameUniqueError = "";

function validateBenutzername($benutzername){
    // Formale Prüfung
    // TODO
    
    // Gibt true zurück, falls es den Benutzernamen bereits gibt
    if (Service::getInstance()->uniqueBenutzername($benutzername)){
        $benutzernameUniqueError = "";
    } //TODO: und dann?
}
function validateVorname($vorname){
    // Formale Vorgaben prüfen
    
}

function validateNachname($nachname){
    // Formale Vorgaben prüfen
    
}

function validatePassword1($password1){
    // Formale Vorgaben prüfen
    
}

function validatePassword2($password2){
    // Übereinstimmung mit password1 prüfen
    
}

function validateLogin() {
    $complete = isset($_POST['benutzername']) AND isset($_POST['password']);
    $type = $complete AND is_int(intval($_POST['benutzername']));

    if ($type) {
        return true;
    } else {
        echo "Eingabe ist nicht korrekt";
        return false;
        //Meldung ausgeben, ob nicht vollständig oder Typ nicht stimmt
    }
}

function validateRegister() {
    $complete = isset($_POST['name']) AND isset($_POST['benutzername']) AND isset($_POST['password']);
    $type = $complete AND is_int(intval($_POST['benutzername']));

    if ($type) {
        echo "Eingabe ist korrekt";
        return true;
    } else {
        echo "Eingabe ist nicht korrekt";
        return false;
        //Meldung ausgeben, ob nicht vollständig oder Typ nicht stimmt
    }
}

?>