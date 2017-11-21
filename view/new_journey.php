<?php

use database\Database;

/*
 * View, um eine neue Reise zu erfassen
 */
?>

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
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/reise" ?>">Reise</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung" ?>">Rechnung</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/teilnehmer" ?>">Teilnehmer</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/profil" ?>">Profil</a></li>
                    </ul>
                </div>
                <div id="blockleft">
                    <table>
                        <tr>
                            <td><img src="../design/pictures/plus.png"></td><td>neue Reise erstellen</td>
                        </tr>
                    </table>
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <table>
                            <tr>
                                <td>Reisetitel</td>
                                <td><input type="text" name="reise" value="" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Beschreibung</td>
                                <td><input type="text" name="beschreibung" value="" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Dauer</td>
                                <td><input type="text" name="duration" value="" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Preis</td>
                                <td><input type="text" name="preis" value="" size="40px" /></td>
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
                        </table>
                    </form>
                </div>
                <div id="blockright">
                    <form action=""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <table> 
                            <tr>
                                <td>Standort</td>
                                <td><input type="text" name="standort" value="" size="40px" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Karte</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" class="button" value="erstellen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
