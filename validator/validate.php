<?php

/*
 * Serverseitige Validierung von Formulareingaben
 */

namespace validator;

use service\Service;

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
$benutzernameRegisterError = "";
$vornameRegisterError = "";
$nachnameRegisterError = "";
$password1RegisterError = "";
$password2RegisterError = "";
$benutzernameUniqueError = "";
$vornameCharError = "";
$nachnameCharError = "";
$password1CharError = "";
$password1ConfirmError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["benutzername"])) {
    $benutzernameRegisterError = "Die Eingabe eines Benutzernamens ist erforderlich!";
  } else {
    validateBenutzername($_POST["benutzername"]);
  }
  
  if (empty($_POST["vorname"])) {
    $vornameRegisterError = "Die Eingabe eines Vornamens ist erforderlich!";
  } else {
    validateVorname($_POST["vorname"]);
  }  

  if (empty($_POST["nachname"])) {
    $nachnameRegisterError = "Die Eingabe eines Nachnamens ist erforderlich!";
  } else {
    validateNachname($_POST["nachname"]);
  }    
  
  if (empty($_POST["password1"])) {
    $password1RegisterError = "Die Eingabe eines Passwortes ist erforderlich!";
  } else {
    validatePassword1($_POST["password1"]);
  }
  
  if (empty($_POST["password2"])) {
    $password2RegisterError = "Die Bestätigung des Passwortes ist erforderlich!";
  } else {
    validatePassword2($_POST["password1"],$_POST["password2"]);
  }  
  
}

// Prüft, ob der Benutzername eindeutig ist
function validateBenutzername($benutzername){
    // Gibt true zurück, falls es den Benutzernamen bereits gibt
    if (Service::getInstance()->uniqueBenutzername($benutzername)){
        $benutzernameUniqueError = "Den Benutzernamen gibt es bereits. Wählen Sie einen anderen.";
    }
}

// Prüft, ob der Vorname den formalen Vorgaben entspricht
function validateVorname($vorname){
    // preg_match gibt 1 zurück, falls der String nur Buchstaben und Leerzeichen enthält
    if(1 !== preg_match('/^[a-zA-Z ]$/', $vorname)){
        $vornameCharError = "Der Vorname darf nur Buchstaben enthalten!";
    }
    
}

// Prüft, ob der Nachname den formalen Vorgaben entspricht
function validateNachname($nachname){
    // preg_match gibt 1 zurück, falls der String nur Buchstaben und Leerzeichen enthält
    if(1 !== preg_match('/^[a-zA-Z ]$/', $nachname)){
        $nachnameCharError = "Der Nachname darf nur Buchstaben enthalten!";
    }
    
}

// Prüft, ob das Passwort den formalen Vorgaben entspricht
function validatePassword1($password1){
    // preg_match gibt 1 zurück, falls der String nur Buchstaben und Leerzeichen enthält
    if(1 === preg_match('/^[a-zA-Z ]$/', $password1)){
        $password1CharError = "Das Passwort darf nicht nur aus Buchstaben bestehen!";
    }
    
}

// Prüft, ob password1 mit password2 übereinstimmt
function validatePassword2($password1, $password2){
    if (password1 !== password2){
        $password1ConfirmError = "Das bestätigte Passwort stimmt nicht überein!";
    }
    
}



?>