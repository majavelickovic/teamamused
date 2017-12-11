<?php

use service\Service;
use domain\Teilnehmer;
use controller\ErrorController;

/*
 * View, um einen einzelnen Teilnehmer anzusehen / zu bearbeiten
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Teilnehmer</title>
    </head>
    <body>		
        <div id="whiteblock">
            <div id="block">
                <div id="navblock">
                    <ul>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/reise" ?>">Reise</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/rechnung" ?>">Rechnung</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/teilnehmer" ?>">Teilnehmer</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/logout" ?>">Logout</a></li>
                    </ul>
                </div>
                <form action="<?php echo $GLOBALS["ROOT_URL"]; ?>/teilnehmer/anzeige" method="POST">
                    <div id="blockleft">
                        <table>
                            <tr>
                                <td colspan="3"><img src="../design/pictures/search.png"></td><td>bestehende Teilnehmer anzeigen</td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>Teilnehmer-ID</td>
                                <td><input type="text" id="teilnehmer_id" name="teilnehmer_id" style="width:296px;" value="<?php echo $teilnehmer_id; ?>" readonly/></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Reise</td>
                                <td>
                                    <select id="titel" name="titel" class="dropdown" style="width:300px;" disabled>
                                        <?php
                                        //Abfrage für Reisetitel
                                        foreach (Service::getInstance()->getJourneyTitles() as $key => $invoiceType) {
                                            if ($invoiceType['reise_id'] == $rg->getReise()) {
                                                echo "<option selected='selected' value='" . $invoiceType['reise_id'] . "'>" . $invoiceType['titel'] . ", " . $invoiceType['reise_id'] . "</option>";
                                            } else {
                                                echo "<option value='" . $invoiceType['reise_id'] . "'>" . $invoiceType['titel'] . ", " . $invoiceType['reise_id'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><a href="#"><img src='../design/pictures/edit.png' onclick='document.getElementById("reise").disabled = false'></a></td>
                            </tr>
                            <tr>
                                <td>Vorname</td>
                                <td><input type="text" name="vorname" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Nachname</td>
                                <td><input type="text" name="nachname" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Geburtsdatum</td>
                                <td><input type="text" name="geburtsdatum" size="40px" /></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>