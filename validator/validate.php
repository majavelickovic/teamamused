<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validateLogin() {
    $complete = 'false';
    $type = 'false';
    $unique = 'false';

    if (isset($_POST['name']) AND isset($_POST['userID']) AND isset($_POST['password'])) {
        $complete = 'true';
    } else {
        $complete = 'false';
    }

    if (is_string($_POST['name']) AND is_int($_POST['userID'])) {
        $type = 'true';
    } else {
        $type = 'false';
    }

    // if für Abgleich der UserID auf Eindeutigkeit


    if ($complete = 'true' AND $type = 'true' AND $unique = 'true') {
        echo "Eingabe ist korrekt";
        return 'true';
    } else {
        echo "Eingabe ist nicht korrekt";
        return 'false';
        //Meldung ausgeben, ob nicht vollständig oder Typ nicht stimmt
    }
}

?>