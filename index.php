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

Router::route("GET", "/welcome", function() {
    if(AuthentifizController::authenticate()) {
        controller\LoginController::welcomeView();
    } else {
        controller\ErrorController::error403View();
    }
});

Router::route("GET", "/logout", function() {
    AuthentifizController::logout();
    controller\LoginController::loginView();
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
    if(AuthentifizController::authenticate()) {
        controller\RechnungController::invoiceAddView();
    } else {
        controller\ErrorController::error403View();
    }
});

Router::route("POST", "/rechnung/neu", function () {
    if(AuthentifizController::authenticate()) {
        controller\RechnungController::invoiceAddView();
        $returnrg = controller\RechnungController::newInvoice();
        if($returnrg != false){
            try{
                $allowedExts = array(
                    "pdf"
                ); 

                //Erlaube MIME-Typen für Rechnungsupload
                $allowedMimeTypes = array( 
                    'application/pdf'
                );

                mkdir('invoices', 0777, true);
                chmod('invoices', 0777);

                $fileToUpload = $_FILES["dokument"]["name"];
                $arrayFileString = explode('.', $fileToUpload);
                $extension = $arrayFileString[sizeof($arrayFileString)-1];

                //Prüfen, ob die Datei nicht zu gross ist
                if ( 20000000 < $_FILES["dokument"]["size"]  ) {
                  throw new Exception('Das PDF ist zu gross für den Upload.' );
                }

                if ( ! ( in_array($extension, $allowedExts ) ) ) {
                    throw new Exception('Please provide another file type [E/2].');
                }

                //Prüfen, ob der MIME-Typ stimmt undn wenn ja, Upload auf Server
                if ( in_array( $_FILES["dokument"]["type"], $allowedMimeTypes ) ) 
                {      
                    move_uploaded_file($_FILES["dokument"]["tmp_name"], "invoices/" . $fileToUpload); 
                }
                else{
                    throw new Exception('Bitte ein PDF raufladen, andere Typen nicht erlaubt.' . $_FILES["dokument"]["type"]);
                }
            }catch(Exception $e){
                //mache nichts
            }
            ?>
            <script type="text/javascript">
                alert("Rechnung <?php echo $returnrg->getRg_id()?> wurde erstellt.");
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("FEHLER - Rechnung konnte nicht erstellt werden. Bitte versuchen Sie es erneut.");
            </script>
            <?php
        }
    } else {
        controller\ErrorController::error403View();
    }
});

Router::route("GET", "/rechnung/bestehend", function () {
    if(AuthentifizController::authenticate()) {
        controller\RechnungController::invoiceShowView();
    } else {
        controller\ErrorController::error403View();
    }
});

Router::route("POST", "/rechnung/bestehend", function () {
    if(AuthentifizController::authenticate()) {
        controller\RechnungController::invoiceShowView();
    } else {
        controller\ErrorController::error403View();
    }
});

Router::route("GET", "/rechnung/anzeige", function () {
    if(AuthentifizController::authenticate()) {
         controller\RechnungController::invoiceShowSingleView();
    } else {
        controller\ErrorController::error403View();
    }
});

Router::route("POST", "/rechnung/anzeige", function () {
    if(AuthentifizController::authenticate()) {
        //controller\RechnungController::updateInvoice();
        //test
            echo "RG:" . $_POST["rg_id"];
            echo "KOSTEN:" . $_POST["kosten"];
            echo "ID:" . $_POST["id"];
            $pdo = database\Database::connect();
            $statement = $pdo->prepare(
                "UPDATE rechnung SET rechnungsart = :rechnungsart, kosten = :kosten, beschreibung = :beschreibung, dokument = :dokument
                WHERE rg_id = :rg_id");
            $statement->bindValue(':rg_id', $_POST["rg_id"]);
            $statement->bindValue(':rechnungsart', $_POST["rgart"]);
            $statement->bindValue(':kosten', $_POST["kosten"]);
            $statement->bindValue(':beschreibung', $_POST["beschreibung"]);
            $statement->bindValue(':dokument', $_POST["dokument"]);
            $statement->execute();
            
            $statement2 = $pdo->prepare(
                "UPDATE reise_rechnung SET reise_id = :reise WHERE rg_id = :rg_id");
            $statement2->bindValue(':reise', $_POST["reise"]);
            $statement2->bindValue(':rg_id', $_POST["rg_id"]);
            $statement2->execute();        
//controller\RechnungController::invoiceShowSingleView();
    }else {
        controller\ErrorController::error403View();
    }
});

Router::route("GET", "/rechnung", function () {
    if(AuthentifizController::authenticate()) {
        controller\RechnungController::invoiceChoiceView();
    } else {
        controller\ErrorController::error403View();
    }
});

Router::route("POST", "/rechnung/schlussabrechnung", function () {
    if(AuthentifizController::authenticate()) {
        controller\PDFController::pdfCalculationView();
    } else {
        controller\ErrorController::error403View();
    }
});

Router::route("GET", "/rechnung/schlussabrechnung", function () {
    if(AuthentifizController::authenticate()) {
        controller\RechnungController::finalBillingView();
    } else {
        controller\ErrorController::error403View();
    }
});

Router::route("GET", "/pdfCalculation", function () {
    if(AuthentifizController::authenticate()) {
        controller\PDFController::pdfCalculationView();
    } else {
        controller\ErrorController::error403View();
    }
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

Router::route("GET", "/deleteInvoice", function () {
    require_once("controller/RechnungController.php");
});


Router::call_route($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO'], $errorFunction);
?>
</body>
</html>
