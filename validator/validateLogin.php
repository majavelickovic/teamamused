<?php

/*
 * Serverseitige Validierung von Formulareingaben
 */

namespace validator;

// Testet den Input, um Cross-Site-Scripting zu verhindern
function testInput($data){
    $data = trim($data); // entfernt Whitespace
    $data = stripslashes($data); // entfernt Anführungszeichen
    $data = htmlspecialchars($data); // entfernt html-Tags
    return $data;
}

// Validierung der Login-Seite bezüglich Vollständigkeit der Inputfelder
$benutzernameLoginError = "";
$passwordLoginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    echo "hello world";
    
  if (empty(testInput($_POST["benutzername"]))) {
    $benutzernameLoginError = "Die Eingabe eines Benutzernamens ist erforderlich!";
  }

  if (empty(testInput($_POST["password"]))) {
    $passwordLoginError = "Die Eingabe eines Passwortes ist erforderlich!";
  }
}

?>