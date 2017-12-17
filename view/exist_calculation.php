<?php

use service\Service;

/*
 * View, um eine besthende Rechnung zu suchen
 * @author Maja Velickovic
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Rechnung</title>
        <script type="text/javascript">
            //Seite aktualisieren, damit die Tabelle aktualisiert angzeigt wird
            function refreshTable() {
                document.getElementById("searchForm").submit();
            }
            //Bild zum Rechnung löschen wurde angeklickt, wenn der Benutzer bestätigt, wird die Rechnung gelöscht und die Ansicht aktualisiert
            function deleteInvoice(rg_id) {
                if (confirm("Wollen Sie die Rechnung wirklich löschen?")) {
                    var req = new XMLHttpRequest();
                    req.open('GET', '/deleteInvoice?del_rg_id=' + rg_id);

                    req.onreadystatechange = function () {
                        if (req.readyState == 4 && req.status == 200) {
                            alert("Die Rechnung " + rg_id + " wurde gelöscht.");
                            refreshTable();
                        }
                    }
                    req.send(null);
                } else {
                    //nichts tun, wenn der Benutzer die Rechnung nicht löschen möchte
                }
            }
        </script>
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
                <div id="blockleft">
                    <table>
                        <tr>
                            <td><img src="../design/pictures/search.png"></td><td>bestehende Rechnung anzeigen</td>
                        </tr>
                    </table>
                    <form id="searchForm" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/rechnung/bestehend" method="POST">
                        <table>
                            <tr>
                                <td>Reise</td>
                                <td>
                                    <select id="dropdown" name="reise" style="width:300px;">
                                        <?php
                                        if ($_POST['reise'] == "") {
                                            echo "<option selected='selected' value=''></option>";
                                        } else {
                                            echo "<option value=''></option>";
                                        }
                                        //Abfrage für Reisetitel
                                        foreach (Service::getInstance()->getJourneyTitles() as $key => $journeyTitle) {
                                            if ($_POST['reise'] == $journeyTitle['reise_id']) {
                                                echo "<option selected='selected' value='" . $journeyTitle['reise_id'] . "'>" . $journeyTitle['titel'] . ", " . $journeyTitle['reise_id'] . "</option>";
                                            } else {
                                                echo "<option value='" . $journeyTitle['reise_id'] . "'>" . $journeyTitle['titel'] . ", " . $journeyTitle['reise_id'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Rechnung-ID</td>
                                <td><input type="text" name="rg_id" style="width:296px;" value="<?php echo $_POST['rg_id'] ?>"/></td>
                            </tr>
                            <tr>
                                <td>Rechnungsart</td>
                                <td>
                                    <select id="dropdown" name="rgart" style="width:300px;">
                                        <?php
                                        if ($_POST['rgart'] == "") {
                                            echo "<option selected='selected' value=''></option>";
                                        } else {
                                            echo "<option value=''></option>";
                                        }
                                        // Abfrage für Rechnungsarten
                                        foreach (Service::getInstance()->getInvoiceTypes() as $key => $invoiceType) {
                                            if ($_POST['rgart'] == $invoiceType['rgart_id']) {
                                                echo "<option selected='selected' value='" . $invoiceType['rgart_id'] . "'>" . $invoiceType['beschreibung'] . "</option>";
                                            } else {
                                                echo "<option value='" . $invoiceType['rgart_id'] . "'>" . $invoiceType['beschreibung'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" class="button" value="suchen"/>  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="blockright" overflow="scroll">
                    <table id="rgTable">
                        <tr>
                            <th>Rechnungs-ID</th>
                            <th>Reise-ID</th>
                            <th>Rechnungsart</th>
                            <th>Kosten</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        $rgtablecontent = controller\RechnungController::readInvoice();
                        if ($rgtablecontent != null) {
                            echo $rgtablecontent;
                        } else {
                            echo "<tr><td colspan='6'>Keine Resultate gefunden. Bitte mindestens einen Filter selektieren, um zu suchen.</td></tr>";
                        }
                        ?>
                    </table>  
                </div>
            </div>
        </div>
    </body>
</html>

