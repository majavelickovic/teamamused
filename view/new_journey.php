<?php

use database\Database;
use service\Service;

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
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/logout" ?>">Logout</a></li>
                    </ul>
                </div>
                <div id="blockleft">
                    <table>
                        <tr>
                            <td><img src="../design/pictures/plus.png"></td><td>neue Reise erstellen</td>
                        </tr>
                    </table>
                    <form action="<?php echo $GLOBALS["ROOT_URL"]; ?>/reise/neu" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>Reisetitel</td>
                                <td><input type="text" name="reise" value="" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Beschreibung</td>
                                <td><textarea name="beschreibung" rows="4" cols=""></textarea></td>
                            </tr>
                            <tr>
                                <td>Datum von</td>
                                <td><input type="text" name="datum_start" value="" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Datum bis</td>
                                <td><input type="text" name="datum_ende" value="" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Preis</td>
                                <td><input type="text" name="preis" value="" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Reiseleiter</td>
                                <td>
                                    <select id="dropdown" name="reiseleiter">
                                        <option value=""></option>
                                        <option value=""></option>
                                        <option value=""></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Startort</td>
                                <td><input type="text" name="startort" value="" size="40px" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" class="button" value="erstellen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="blockright">

                </div>
            </div>
        </div>
    </body>
</html>
