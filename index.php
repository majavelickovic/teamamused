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
            if (AuthentifizController::authenticate()) {
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
            if (controller\LoginController::register()) {
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
            if (AuthentifizController::authenticate()) {
                controller\LoginController::welcomeView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/", function () {
            Router::redirect("/login");
        });

        Router::route("GET", "/welcome", function() {
            if (AuthentifizController::authenticate()) {
                controller\LoginController::welcomeView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/logout", function() {
            AuthentifizController::logout();
            controller\LoginController::loginView();
        });

        Router::route("GET", "/reise", function () {
            if (AuthentifizController::authenticate()) {
                controller\ReiseController::journeyChoiceView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/reise/neu", function () {
            if (AuthentifizController::authenticate()) {
                controller\ReiseController::journeyAddView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/reise/neu", function () {
            if (AuthentifizController::authenticate()) {
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
            if (AuthentifizController::authenticate()) {
                controller\ReiseController::journeyShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/reise/bestehend", function () {
            if (AuthentifizController::authenticate()) {
                controller\ReiseController::journeyShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/reise/anzeige", function () {
            if (AuthentifizController::authenticate()) {
                controller\ReiseController::journeyShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/reise/anzeige", function () {
            if (AuthentifizController::authenticate()) {
                controller\ReiseController::updateJourney();
                controller\ReiseController::journeyShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/rechnung/neu", function () {
            if (AuthentifizController::authenticate()) {
                controller\RechnungController::invoiceAddView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/rechnung/neu", function () {
            if (AuthentifizController::authenticate()) {
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
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/rechnung/bestehend", function () {
            if (AuthentifizController::authenticate()) {
                controller\RechnungController::invoiceShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/rechnung/bestehend", function () {
            if (AuthentifizController::authenticate()) {
                controller\RechnungController::invoiceShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/rechnung/anzeige", function () {
            if (AuthentifizController::authenticate()) {
                controller\RechnungController::invoiceShowSingleView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/rechnung/anzeige", function () {
            if (AuthentifizController::authenticate()) {
                controller\RechnungController::updateInvoice();
                controller\RechnungController::invoiceShowSingleView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/rechnung", function () {
            if (AuthentifizController::authenticate()) {
                controller\RechnungController::invoiceChoiceView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/rechnung/schlussabrechnung", function () {
            if (AuthentifizController::authenticate()) {
                controller\PDFController::pdfCalculationView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/rechnung/schlussabrechnung", function () {
            if (AuthentifizController::authenticate()) {
                controller\RechnungController::finalBillingView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/pdfCalculation", function () {
            if (AuthentifizController::authenticate()) {
                controller\PDFController::pdfCalculationView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/testDB", function () {
            require_once("view/testDBConnect.php");
        });

        Router::route("GET", "/deleteInvoice", function () {
            require_once("controller/RechnungController.php");
        });

        Router::route("GET", "/teilnehmer", function () {
            if (AuthentifizController::authenticate()) {
                controller\TeilnehmerController::participantChoiceView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/teilnehmer/neu", function () {
            if (AuthentifizController::authenticate()) {
                controller\TeilnehmerController::participantAddView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/teilnehmer/neu", function () {
            if (AuthentifizController::authenticate()) {
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
                        alert("FEHLER - Die Reise konnte nicht erstellt werden. Bitte versuchen Sie es erneut.");
                    </script>
                    <?php
                }
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/teilnehmer/bestehend", function () {
            if (AuthentifizController::authenticate()) {
                controller\TeilnehmerController::participantShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/teilnehmer/bestehend", function () {
            if (AuthentifizController::authenticate()) {
                controller\TeilnehmerController::participantShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("GET", "/teilnehmer/anzeige", function () {
            if (AuthentifizController::authenticate()) {
                controller\TeilnehmerController::participantShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });

        Router::route("POST", "/teilnehmer/anzeige", function () {
            if (AuthentifizController::authenticate()) {
                controller\TeilnehmerController::updateParticipant();
                controller\TeilnehmerController::participantShowView();
            } else {
                controller\ErrorController::error403View();
            }
        });


        Router::call_route($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO'], $errorFunction);
        ?>
    </body>
</html>
