<?php

use service\Service;

/*
 * View, um eine besthende Rechnung zu suchen
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Reise</title>
        <script type="text/javascript">
            //Seite aktualisieren, damit die Tabelle aktualisiert angzeigt wird
            function refreshTable() {
                document.getElementById("searchForm").submit();
            }
            //Bild zum Rechnung löschen wurde angeklickt, wenn der Benutzer bestätigt, wird die Rechnung gelöscht und die Ansicht aktualisiert
            function deleteJourney(reise_id) {
                if (confirm("Wollen Sie die Reise wirklich löschen?")) {
                    var req = new XMLHttpRequest();
                    req.open('GET', '/deleteJourney?del_reise_id=' + reise_id);

                    req.onreadystatechange = function () {
                        if (req.readyState == 4 && req.status == 200) {
                            alert("Die Reise " + reise_id + " wurde gelöscht.");
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
                            <td><img src="../design/pictures/search.png"></td><td>bestehende Reise anzeigen</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>Reise-ID</td>
                            <td><input type="text" name="reise_id" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Reisetitel</td>
                            <td><input type="text" name="beschreibung" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Reiseleiter</td>
                            <td>
                                <select id="dropdown" name="reiseleiter">
                                    <option value="">Maja</option>
                                    <option value="">Sandra</option>
                                    <option value="">Michelle</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Datum von</td>
                            <td><input type="text" name="datum_start" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Datum bis</td>
                            <td><input type="text" name="datum_ende" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Preis</td>
                            <td><input type="range" id="preis" min="0" max="1000" value="0" /></td>
                        </tr>
                        <tr>
                            <td>Startort</td>
                            <td><input type="text" name="startort" size="40px" /></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" class="button" value="suchen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                        </tr>
                    </table>
                </div>
                <div id="blockright">
                    <table id="reiseTable">
                        <tr>
                            <th>Reise-ID</th>
                            <th>Reisetitel</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        $reisetablecontent = controller\ReiseController::readJourney();
                        if ($reisetablecontent != null) {
                            echo $reisetablecontent;
                        } else {
                            echo "";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
