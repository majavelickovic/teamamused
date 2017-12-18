<?php

use service\Service;

/*
 * View, um eine neue Reise zu erfassen
 * @author Sandra Bodack
 */
?>

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
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/reise" ?>">Reise</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/rechnung" ?>">Rechnung</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/teilnehmer" ?>">Teilnehmer</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/logout" ?>">Logout</a></li>
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
                                <td><input type="text" name="titel" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Beschreibung</td>
                                <td><textarea name="beschreibung" rows="4" cols="36"></textarea></td>
                            </tr>
                            <tr>
                                <td>Datum von</td>
                                <td><input type="date" name="datum_start" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Datum bis</td>
                                <td><input type="date" name="datum_ende" /></td>
                            </tr>
                            <tr>
                                <td>Preis</td>
                                <td><input type="text" name="preis" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Max. Teilnehmer</td>
                                <td><input type="text" name="max_teilnehmer" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Startort</td>
                                <td>
                                    <select id="dropdown" name="startort">
                                        <?php
                                        if ($_POST['ort_id'] == "") {
                                            echo "<option selected='selected' value=''></option>";
                                        } else {
                                            echo "<option value=''></option>";
                                        }
                                        //Abfrage für Standorte
                                        foreach(Service::getInstance()->getPlaces() as $key => $startort) {
                                            echo "<option value='" . $startort['ort_id'] . "'>" . $startort['ort_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
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
