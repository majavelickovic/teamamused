<?php

use service\Service;

/*
 * View, um eine besthende Rechnung zu suchen
 * @author Sandra Bodack
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
            //Bild zum Reise löschen wurde angeklickt, wenn der Benutzer bestätigt, wird die Reise gelöscht und die Ansicht aktualisiert
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
                    //nichts tun, wenn der Benutzer die Reise nicht löschen möchte
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
                    <form id="searchForm" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/reise/bestehend" method="POST">
                        <table>
                            <tr>
                                <td>Reise-ID</td>
                                <td><input type="text" name="reise_id" style="width:296px;" value="<?php echo $_POST['reise_id'] ?>"/></td>
                            </tr>
                            <tr>
                                <td>Reisetitel</td>
                                <td><input type="text" name="titel" style="width:296px;" value="<?php echo $_POST['titel'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>Preis</td>
                                <td><input type="text" name="preis" style="width:296px;" value="<?php echo $_POST['preis'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>Startort</td>
                                <td>
                                    <select id="dropdown" name="startort">
                                        <?php
                                        //Abfrage für Standorte
                                        foreach (Service::getInstance()->getPlaces() as $key => $standorte) {
                                            echo "<option value='" . $standorte['ort_id'] . "'>" . $standorte['ort_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" class="button" value="suchen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                            </tr>
                        </table>
                    </form>
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
