<!DOCTYPE html>
<!--
Diese Seite stellt die Reise-Seite dar.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Reise</title>
        <script type="text/javascript">
            function refreshTable() {
                document.getElementById("Table").refresh();
            }
        </script>
    </head>
    <body>		
        <div id="whiteblock">
            <div id="block">
                <div id="navblock">
                    <ul>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/reise" ?>">Reise</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung" ?>">Rechnung</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/teilnehmer" ?>">Teilnehmer</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/profil" ?>">Profil</a></li>
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
                            <td><input type="text" name="reise_id" value="" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Reisetitel</td>
                            <td><input type="text" name="beschreibung" value="" size="40px" /></td>
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
                            <td>Dauer</td>
                            <td><input type="text" name="duration" value="" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Preis</td>
                            <td><input type="range" id="preis" min="0" max="1000" value="0" /></td>
                        </tr>
                        <tr>
                            <td>Standort</td>
                            <td><input type="text" name="standort" value="" size="40px" /></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" class="button" value="suchen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
