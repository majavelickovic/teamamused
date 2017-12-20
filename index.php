<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Verwaltungstool Reisen</title>
    </head>
    <body>

        <?php
        require_once("config/Autoloader.php");

        use router\Router;
        use controller\LoginController;

/*
         * Startet eine neue Session - muss auf nachfolgenden Seiten nicht implementiert werden,
         * da die Kommunikation über das Index-File läuft
         */
        session_start();

        /*
         * Wenn die Session-Variable login noch nicht gesetzt wurde, wird der User auf die Login-Seite umgeleitet
         */
        $authFunction = function () {
            if (LoginController::authenticate()) {
                return true;
            } else {
                Router::redirect("/login");
                return false;
            }
        };

        /*
         * Wenn eine Seite nicht gefunden werden kann, erscheint ein 404-Fehler
         */
        $errorFunction = function () {
            controller\ErrorController::error404View();
        };

        /*
         * Dem User wird die 404-Fehlerseite angezeigt
         * @author Michelle Widmer
         */
        Router::route("GET", "/error404", function () {
            controller\ErrorController::error404View();
        });

        /*
         * Dem User wird die 403-Fehlerseite angezeigt
         * @author Michelle Widmer
         */
        Router::route("GET", "/error403", function () {
            controller\ErrorController::error403View();
        });

        /*
         * Dem User wird die Registrierungsseite angezeigt
         * @author Michelle Widmer
         */
        Router::route("GET", "/register", function () {
            controller\LoginController::registerView();
        });

        /*
         * Wenn die Registrierung erfolgreich verlief und valide ist (boolean), wird der User auf die Login-Seite weitergeleitet
         * @author Michelle Widmer
         */
        Router::route("POST", "/register", function () {
            if (controller\LoginController::register()) {
                Router::redirect("/login");
            } else {
                controller\LoginController::registerView();
            }
        });

        /*
         * Dem User wird die Loginseite angezeigt
         * @author Michelle Widmer
         */
        Router::route("GET", "/login", function () {
            controller\LoginController::loginView();
        });

        /*
         * Die Formulareingaben der Loginseite werden entgegengenommen und validiert
         * Nur ein authentifizierte User gelangt auf die Reiseübersichts-Seite
         * @author Michelle Widmer
         */
        Router::route("POST", "/login", function () {
            LoginController::login();
            if (LoginController::authenticate()) {
                controller\ReiseController::journeyChoiceView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        /*
         * Dem User wird die Loginseite angezeigt
         * @author Michelle Widmer
         */
        Router::route("GET", "/", function () {
            Router::redirect("/login");
        });

        /*
         * Beim Logout wird der User auf die Loginseite weitergeleitet
         * @author Michelle Widmer
         */
        Router::route("GET", "/logout", function() {
            LoginController::logout();
            controller\LoginController::loginView();
        });

        Router::route("GET", "/reise", function () {
            if (LoginController::authenticate()) {
                controller\ReiseController::journeyChoiceView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/reise/neu", function () {
            if (LoginController::authenticate()) {
                controller\ReiseController::journeyAddView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/reise/neu", function () {
            if (LoginController::authenticate()) {
                controller\ReiseController::journeyAddView();
                $returnreise = controller\ReiseController::newJourney();
                if ($returnreise != false) {
                    ?>
                    <script type="text/javascript">
                        alert("Die Reise <?php echo $returnreise->getReise_id() ?> wurde erstellt.");
                    </script>
                    <?php
                } else {
                    ?>
                    <script type="text/javascript">
                        alert("FEHLER - Die Reise konnte nicht erstellt werden. Bitte versuchen Sie es erneut.");
                    </script>
                    <?php
                }
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/reise/bestehend", function () {
            if (LoginController::authenticate()) {
                controller\ReiseController::journeyShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/reise/bestehend", function () {
            if (LoginController::authenticate()) {
                controller\ReiseController::journeyShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/reise/anzeige", function () {
            if (LoginController::authenticate()) {
                controller\ReiseController::journeyShowSingleView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/reise/anzeige", function () {
            if (LoginController::authenticate()) {
                controller\ReiseController::updateJourney();
                controller\ReiseController::journeyShowSingleView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * eine bestimmte Reise wird gelöscht
         * @author Sandra Bodack
         */
        Router::route("GET", "/deleteJourney", function () {
            if (LoginController::authenticate() && $_GET['del_reise_id'] > 0) {
                controller\ReiseController::deleteJourney($_GET['del_reise_id']);
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * Neue Rechnung wird von Benutzer erfasst
         * @author Maja Velickovic
         */
        Router::route("GET", "/rechnung/neu", function () {
            if (LoginController::authenticate()) {
                controller\RechnungController::invoiceAddView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * Rechnungsformular wurde von Benutzer submittet, Rechnung wird erstellt
         * @author Maja Velickovic
         */
        Router::route("POST", "/rechnung/neu", function () {
            if (LoginController::authenticate()) {
                //Datei muss mit PDF enden oder darf auch leer sein
                if((substr($_FILES["dokument"]["name"], strlen($_FILES["dokument"]["name"])-4, strlen($_FILES["dokument"]["name"])) != ".pdf") && $_FILES["dokument"]["name"] != ""){
                    ?>
                    <script type="text/javascript">
                        alert("Nur PDF ist als Anhang erlaubt. Bitte Format vom Rechnungsanhang ändern. Rechnung konnte nicht gespeichert werden.");
                    </script>
                    <?php
                        controller\RechnungController::invoiceAddView();
                }else{
                    controller\RechnungController::invoiceAddView();
                    $returnrg = controller\RechnungController::newInvoice();
                    if ($returnrg != false) {
                        ?>
                        <script type="text/javascript">
                            alert("Rechnung <?php echo $returnrg->getRg_id() ?> wurde erstellt.");
                        </script>
                        <?php
                    } else {
                        ?>
                        <script type="text/javascript">
                            alert("FEHLER - Rechnung konnte nicht erstellt werden. Bitte versuchen Sie es erneut.");
                        </script>
                        <?php
                    }
                }
 
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * bestehende Rechnungen können über ein Formular abgerufen werden
         * @author Maja Velickovic
         */
        Router::route("GET", "/rechnung/bestehend", function () {
            if (LoginController::authenticate()) {
                controller\RechnungController::invoiceShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * Formular, um Rechnungen zu suchen wurde ausgefüllt, Tabelle mit Rechnungen werden dem Benutzer ausgewiesen
         * @author Maja Velickovic
         */
        Router::route("POST", "/rechnung/bestehend", function () {
            if (LoginController::authenticate()) {
                controller\RechnungController::invoiceShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * Eine konkrete bestehende Rechnung wird dem Benutzer in einem Formular angezeigt
         * @author Maja Velickovic
         */
        Router::route("GET", "/rechnung/anzeige", function () {
            if (LoginController::authenticate()) {
                controller\RechnungController::invoiceShowSingleView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * Änderungen an einer behenden Rechnungen werden gespeichert
         * @author Maja Velickovic
         */
        Router::route("POST", "/rechnung/anzeige", function () {
            if (LoginController::authenticate()) {
                controller\RechnungController::updateInvoice();
                controller\RechnungController::invoiceShowSingleView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * Übersichtsseite für Optionen für eine Rechnung werden angezeigt
         * @author Maja Velickovic
         */
        Router::route("GET", "/rechnung", function () {
            if (LoginController::authenticate()) {
                controller\RechnungController::invoiceChoiceView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * Formular für Schlussabrechnung wurde submitted, Schlussabrechnung (FPDF) wird aufgerufen
         * @author Maja Velickovic
         */
        Router::route("POST", "/rechnung/schlussabrechnung", function () {
            if (LoginController::authenticate()) {
                controller\PDFController::pdfCalculationView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * Formular für Schlussabrechnung wird augerufen, der Benutzer kann hier eine Reise selektieren
         * @author Maja Velickovic
         */
        Router::route("GET", "/rechnung/schlussabrechnung", function () {
            if (LoginController::authenticate()) {
                controller\RechnungController::finalBillingView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * PDF von angehängter Rechnung wird angezeigt
         * @author Maja Velickovic
         */
        Router::route("GET", "/showSingleCalcPDF", function () {
            if (LoginController::authenticate()) {
                controller\PDFController::showSingleCalcPDF();
            } else {
                controller\ErrorController::error403View();
            }
        });

        /**
         * eine bestimmte Rechnung wird gelöscht
         * @author Maja Velickovic
         */
        Router::route("GET", "/deleteInvoice", function () {
            if (LoginController::authenticate() && $_GET['del_rg_id'] > 0) {
                controller\RechnungController::deleteInvoice($_GET['del_rg_id']);
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/teilnehmer", function () {
            if (LoginController::authenticate()) {
                controller\TeilnehmerController::participantChoiceView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/teilnehmer/neu", function () {
            if (LoginController::authenticate()) {
                controller\TeilnehmerController::participantAddView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/teilnehmer/neu", function () {
            if (LoginController::authenticate()) {
                controller\TeilnehmerController::participantAddView();
                $returnteilnehmer = controller\TeilnehmerController::newParticipant();
                if ($returnteilnehmer != false) {
                    ?>
                    <script type="text/javascript">
                        alert("Der Teilnehmer <?php echo $returnteilnehmer->getTeilnehmer_id() ?> wurde erstellt.");
                    </script>
                    <?php
                } else {
                    ?>
                    <script type="text/javascript">
                        alert("FEHLER - Der Teilnehmer konnte nicht erstellt werden. Bitte versuchen Sie es erneut.");
                    </script>
                    <?php
                }
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/teilnehmer/bestehend", function () {
            if (LoginController::authenticate()) {
                controller\TeilnehmerController::participantShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/teilnehmer/bestehend", function () {
            if (LoginController::authenticate()) {
                controller\TeilnehmerController::participantShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/teilnehmer/anzeige", function () {
            if (LoginController::authenticate()) {
                controller\TeilnehmerController::participantShowSingleView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/teilnehmer/anzeige", function () {
            if (LoginController::authenticate()) {
                controller\TeilnehmerController::updateParticipant();
                controller\TeilnehmerController::participantShowSingleView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/deleteParticipant", function () {
            if (LoginController::authenticate() && $_GET['del_teilnehmer_id'] > 0) {
                controller\TeilnehmerController::deleteParticipant($_GET['del_teilnehmer_id']);
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::call_route($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO'], $errorFunction);
        ?>
    </body>
</html>
