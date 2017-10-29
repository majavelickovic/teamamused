<?php

/*
 * Serverseitige Validierung
 */

function validateLogin() {
    $complete = isset($_POST['userID']) && isset($_POST['password']);
    $type = $complete && is_int(intval($_POST['userID']));

    if ($type) {
        return true;
    } else {
        echo "Eingabe ist nicht korrekt";
        return false;
        //Meldung ausgeben, ob nicht vollständig oder Typ nicht stimmt
    }
}

function validateRegister() {
    $complete = isset($_POST['name']) && isset($_POST['userID']) && isset($_POST['password']);
    $type = $complete && is_int(intval($_POST['userID']));

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