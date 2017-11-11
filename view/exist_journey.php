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
                        <li><a href="#reise">Reise</a></li>
                        <li><a href="#rechnung">Rechnung</a></li>
                        <li><a href="#teilnehmer">Teilnehmer</a></li>
                        <li><a href="#profil">Profil</a></li>
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
                            <td><input type="text" name="journeyID" value="" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Reisetitel</td>
                            <td><input type="text" name="journey" value="" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Reiseleiter</td>
                            <td>
                                <select id="dropdown" name="guide">
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
                            <td><input type="range" id="pricerange" min="0" max="1000" value="0" /></td>
                        </tr>
                        <tr>
                            <td>Standort</td>
                            <td><input type="text" name="place" value="" size="40px" /></td>
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
