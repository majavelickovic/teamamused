<?php
require_once("config/Autoloader.php");

use router\Router;
use database\Database;

session_start();

$authFunction = function () {
    // TODO
};

$errorFunction = function () {
    // TODO als eigene Seite
    echo "404 NOT FOUND";
};

Router::route("GET", "/register", function () {
    include_once './view/register.php';
});

Router::route("POST", "/register", function () {
    $pdo = Database::connect();
    $statement = $pdo->prepare("INSERT INTO login (userid) VALUES (:userid)");
    $statement->bindValue(":userid", $_POST['uname']);
    if($statement->execute()) echo "successful";
    else "failed";
});

Router::route("GET", "/login", function () {
    include_once './view/loginView.php';
});

Router::route_auth("GET", "/agent/edit", $authFunction, function () {
    CustomerController::readAll();
});

Router::call_route($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO'], $errorFunction);