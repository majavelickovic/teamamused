<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="design/styles.css">
        <title>Verwaltungstool Reisen</title>
    </head>
</html>

<?php
require_once("config/Autoloader.php");

use router\Router;
use database\Database;
use controller\AuthentifizController;

/*
 * Startet eine neue Session - muss auf nachfolgenden Seiten nicht implementiert werden, da die Kommunikation über das Index-File läuft
 */
session_start();

/*
 * Wenn noch keine Session gestartet wurde, wird der User auf die Login-Seite umgeleitet
 */
$authFunction = function () {
    if (AuthentifizController::authenticate()){
        return true;
    } else {
        Router::redirect("/login");
        return false;        
    }
};

$errorFunction = function () {
    // TODO als eigene Seite realisieren
    echo "404 NOT FOUND";
};

Router::route("GET", "/register", function () {
    controller\LoginController::registerView();
});

/*
 * Wenn die Registrierung erfolgreich verlief, wird der User auf die Login-Seite weitergeleitet
 */
Router::route("POST", "/register", function () {
    if(controller\LoginController::register()){
        Router::redirect("/login");
    } else {
        echo "FEHLER"; // TODO
    }
});

Router::route("GET", "/login", function () {
    controller\LoginController::loginView();
});

Router::route("POST", "/login", function () {
    AuthentifizController::login();
    Router::redirect("/welcome");
});

Router::route("GET", "/", function () {
    Router::redirect("/login");
});

Router::route("GET", "/welcome", function() {
    if(AuthentifizController::authenticate()) {
        controller\LoginController::welcomeView();
    } else {
        echo "403 Access Denied";
    }
});

Router::route("GET", "/reise/neu", function () {
    require_once("view/new_journey.php");
});

Router::route("GET", "/reise", function () {
    require_once("view/journey.php");
});

Router::route("GET", "/reise/bestehend", function () {
    require_once("view/exist_journey.php");
});

Router::route("GET", "/rechnung/neu", function () {
    controller\RechnungController::rechnungHinzufView();
});

Router::route("POST", "/rechnung/neu", function () {
    if(controller\RechnungController::neueRechnung() != false){
        Router::redirect("/rechnung/neu");
    } else {
        echo "FEHLER"; // TODO
    }
});

Router::route("GET", "/rechnung/bestehend", function () {
    require_once("view/exist_calculation.php");
});

Router::route("GET", "/rechnung", function () {
    require_once("view/calculation.php");
});

Router::route("GET", "/teilnehmer", function () {
    require_once("view/participant.php");
});

Router::route("GET", "/teilnehmer/neu", function () {
    require_once("view/new_participant.php");
});

Router::route("GET", "/testDB", function () {
    require_once("view/testDBConnect.php");
});

Router::call_route($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO'], $errorFunction);
