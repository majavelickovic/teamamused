<?php

/*
 * Serverseitige Validierung der Login- und Registrierungseingaben
 */

function validateLogin() {
    $complete = isset($_POST['userID']) AND isset($_POST['password']);
    $type = $complete AND is_int(intval($_POST['userID']));

    if ($type) {
        return true;
    } else {
        echo "Eingabe ist nicht korrekt";
        return false;
        //Meldung ausgeben, ob nicht vollständig oder Typ nicht stimmt
    }
}

function validateRegister() {
    $complete = isset($_POST['name']) AND isset($_POST['userID']) AND isset($_POST['password']);
    $type = $complete AND is_int(intval($_POST['userID']));

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