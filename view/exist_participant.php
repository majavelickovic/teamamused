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
        <title>Teilnehmer</title>
        <script type="text/javascript">
            //Seite aktualisieren, damit die Tabelle aktualisiert angzeigt wird
            function refreshTable() {
                document.getElementById("searchForm").submit();
            }
            //Bild zum Teilnehmer löschen wurde angeklickt, wenn der Benutzer bestätigt, wird die Rechnung gelöscht und die Ansicht aktualisiert
            function deleteParticipant(teilnehmer_id) {
                if (confirm("Wollen Sie den Teilnehmer wirklich löschen?")) {
                    var req = new XMLHttpRequest();
                    req.open('GET', '/deleteParticipant?del_teilnehmer_id=' + teilnehmer_id);

                    req.onreadystatechange = function () {
                        if (req.readyState == 4 && req.status == 200) {
                            alert("Der Teilnehmer " + teilnehmer_id + " wurde gelöscht.");
                            refreshTable();
                        }
                    }
                    req.send(null);
                } else {
                    //nichts tun, wenn der Teilnehmer nicht gelöscht werden möchte
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
                            <td><img src="../design/pictures/search.png"></td><td>bestehender Teilnehmer anzeigen</td>
                        </tr>
                    </table>
                    <form id="searchForm" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/teilnehmer/bestehend" method="POST">
                        <table>
                            <tr>
                                <td>Reise</td>
                                <td>
                                    <select id="dropdown" name="reise" style="width:300px;">
                                        <?php
                                        //Abfrage für Reisetitel
                                        foreach (Service::getInstance()->getJourneyTitles() as $key => $journeyType) {
                                            if ($_POST['reise'] == $journeyType['reise_id']) {
                                                echo "<option selected='selected' value='" . $journeyType['reise_id'] . "'>" . $journeyType['titel'] . ", " . $journeyType['reise_id'] . "</option>";
                                            } else {
                                                echo "<option value='" . $journeyType['reise_id'] . "'>" . $journeyType['titel'] . ", " . $journeyType['reise_id'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Teilnehmer-ID</td>
                                <td><input type="text" name="teilnehmer_id" style="width:296px;" value="<?php echo $_POST['teilnehmer_id'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>Vorname</td>
                                <td><input type="text" name="vorname" style="width:296px;" value="<?php echo $_POST['vorname'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>Nachname</td>
                                <td><input type="text" name="nachname" style="width:296px;" value="<?php echo $_POST['nachname'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>Geburtsdatum</td>
                                <td><input type="text" name="geburtsdatum" style="width:296px;" value="<?php echo $_POST['geburtsdatum'] ?>" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" class="button" value="suchen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="blockright">
                    <table id="participantTable">
                        <tr>
                            <th>Teilnehmer-ID</th>
                            <th>Reise-ID</th>
                            <th>Vorname</th>
                            <th>Nachname</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        $participanttablecontent = controller\TeilnehmerController::readParticipant();
                        if ($participanttablecontent != null) {
                            echo $participanttablecontent;
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
