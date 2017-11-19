<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="design/styles.css">
        <title>Verwaltungstool Reisen</title>
    </head>
    <body>

<?php
require_once("config/Autoloader.php");

use router\Router;
use controller\AuthentifizController;

/*
 * Startet eine neue Session - muss auf nachfolgenden Seiten nicht implementiert werden, da die Kommunikation über das Index-File läuft
 */
session_start();

/*
 * Wenn die Session-Variable login noch nicht gesetzt wurde, wird der User auf die Login-Seite umgeleitet
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
    controller\ErrorController::error404View();
};

Router::route("GET", "/error404", function () {
    controller\ErrorController::error404View();
});

Router::route("GET", "/error403", function () {
    controller\ErrorController::error403View();
});

Router::route("GET", "/register", function () {
    controller\LoginController::registerView();
});

/*
 * Wenn die Registrierung erfolgreich verlief (boolean), wird der User auf die Login-Seite weitergeleitet
 */
Router::route("POST", "/register", function () {
    if(controller\LoginController::register()){
        Router::redirect("/login");
    } else {
        controller\LoginController::registerView();
    }
});

Router::route("GET", "/login", function () {
    controller\LoginController::loginView();
});

Router::route("POST", "/login", function () {
    AuthentifizController::login();
    if(AuthentifizController::authenticate()) {
        controller\LoginController::welcomeView();
    } else {
        controller\ErrorController::error403View();
    }
});

Router::route("GET", "/", function () {
    Router::redirect("/login");
});

// Kommentare löschen, wenn Session funktioniert
Router::route("GET", "/welcome", function() {
    if(AuthentifizController::authenticate()) {
        controller\LoginController::welcomeView();
    } else {
        controller\ErrorController::error403View();
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
    $returnrg = controller\RechnungController::neueRechnung();
    if($returnrg != false){
        ?>
        <script type="text/javascript">
            alert("Rechnung erstellt");
            //alert("Rechnung <?php echo $returnrg->getRg_id()?> wurde erstellt.");
        </script>
        <?php
    } else {
        echo "FEHLER bei Rechnung erstellen"; // TODO
    }
});

Router::route("GET", "/rechnung/bestehend", function () {
    controller\RechnungController::rechnungAnzeigeView();
});

Router::route("POST", "/rechnung/bestehend", function () {
    controller\RechnungController::rechnungAnzeigeView();
});

Router::route("GET", "/rechnung/anzeige", function () {
    controller\RechnungController::rechnungAnzeigeEinzelView($_GET['id']);
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
?>
</body>
</html>