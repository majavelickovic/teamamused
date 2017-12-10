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
        <title>Schlussabrechnung anzeigen</title>
        <script type="text/javascript">
            //Seite aktualisieren, damit die Tabelle aktualisiert angzeigt wird
            function refreshTable() {
                document.getElementById("searchForm").submit();
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
                            <td><img src="../design/pictures/search.png"></td><td>Schlussabrechnung anzeigen f&uuml;r eine Reise</td>
                        </tr>
                    </table>
                    <form id="searchForm" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/rechnung/schlussabrechnung" method="POST">
                        <table>
                            <tr>
                                <td>Reise</td>
                                <td>
                                    <select id="dropdown" name="reise" style="width:300px;">
                                        <?php
                                            //Abfrage für Reisetitel
                                            foreach(Service::getInstance()->getJourneyTitles() as $key => $invoiceType) {
                                                if($_POST['reise'] == $invoiceType['reise_id']){
                                                    echo "<option selected='selected' value='" . $invoiceType['reise_id'] . "'>" . $invoiceType['titel'] . ", " . $invoiceType['reise_id'] . "</option>";
                                                }else{
                                                    echo "<option value='" . $invoiceType['reise_id'] . "'>" . $invoiceType['titel'] . ", " . $invoiceType['reise_id'] . "</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" class="button" value="drucken" />
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

