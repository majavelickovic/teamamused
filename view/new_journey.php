<!DOCTYPE html>
<!--
Diese Seite stellt die Reise-Seite dar.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Reise</title>
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
                            <td><img src="../design/pictures/plus.png"></td><td>neue Reise erstellen</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>Reisetitel</td>
                            <td><input type="text" name="journey" value="" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Beschreibung</td>
                            <td><input type="text" name="discription" value="" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Dauer</td>
                            <td><input type="text" name="duration" value="" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Preis</td>
                            <td><input type="text" name="price" value="" size="40px" /></td>
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
                    </table>
                </div>
                <div id="blockright">
                    <table>
                        <tr>
                            <td>Standort</td>
                            <td><input type="text" name="place" value="" size="40px" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Karte</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" class="button" value="erstellen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
