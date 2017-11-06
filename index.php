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
    Router::redirect("/");
});


Router::call_route($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO'], $errorFunction);