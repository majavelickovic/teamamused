<?php

/*
 * Serverseitige Validierung von Formulareingaben
 */

namespace validator;

use service\Service;

// Testet den Input, um Cross-Site-Scripting zu verhindern
function testInput($data){
    $data = trim($data); // entfernt Whitespace
    $data = stripslashes($data); // entfernt Anführungszeichen
    $data = htmlspecialchars($data); // entfernt html-Tags
    return $data;
}

$benutzernameRegisterError = "";
$vornameRegisterError = "";
$nachnameRegisterError = "";
$password1RegisterError = "";
$password2RegisterError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Prüft den eingegebenen Benutzernamen
    if (empty(testInput($_POST["benutzername"]))) {
    $benutzernameRegisterError = "Die Eingabe eines Benutzernamens ist erforderlich!";
  } else {
        // Gibt true zurück, falls es den Benutzernamen bereits gibt
        if (Service::getInstance()->uniqueBenutzername($_POST["benutzername"])){
            $benutzernameRegisterError = "Den Benutzernamen gibt es bereits. Wählen Sie einen anderen.";
        }
    }
  
  // Prüft den eingegebenen Vornamen
  if (empty(testInput($_POST["vorname"]))) {
    $vornameRegisterError = "Die Eingabe eines Vornamens ist erforderlich!";
    } else {
        // preg_match gibt 1 zurück, falls der String nur Buchstaben und Leerzeichen enthält
        if(1 !== preg_match('/^[a-zA-Z]+$/', testInput($_POST["vorname"]))){
            $vornameRegisterError = "Der Vorname darf nur Buchstaben enthalten!";
        }
    }

  // Prüft den eingegebenen Nachnamen
  if (empty(testInput($_POST["nachname"]))) {
    $nachnameRegisterError = "Die Eingabe eines Nachnamens ist erforderlich!";
    } else {
        // preg_match gibt 1 zurück, falls der String nur Buchstaben und Leerzeichen enthält
        if(1 !== preg_match('/^[a-zA-Z]+$/', testInput($_POST["nachname"]))){
            $nachnameRegisterError = "Der Nachname darf nur Buchstaben enthalten!";
        }
    }    
  
  // Prüft das eingegebene Passwort
  if (empty(testInput($_POST["password1"]))) {
    $password1RegisterError = "Die Eingabe eines Passwortes ist erforderlich!";
    } else {
        // preg_match gibt 1 zurück, falls der String nur Buchstaben und Leerzeichen enthält
        if(1 === preg_match('/^[a-zA-Z]+$/', testInput($_POST["password1"]))){
            $password1RegisterError = "Das Passwort darf nicht nur aus Buchstaben bestehen!";
        }
    }
  
  // Prüft das eingegebene bestätigte Passwort
  if (empty(testInput($_POST["password2"]))) {
    $password2RegisterError = "Die Bestätigung des Passwortes ist erforderlich!";
    } else {
        if (testInput($_POST["password1"]) !== testInput($_POST["password2"])){
            $password2RegisterError = "Das bestätigte Passwort stimmt nicht überein!";
        }
    }  
}
?>