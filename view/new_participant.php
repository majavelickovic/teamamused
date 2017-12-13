<?php

use service\Service;

/*
 * View, um einen neuen Teilnehmer zu erfassen
 * @author Sandra Bodack
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Teilnehmer</title>
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
                            <td><img src="../design/pictures/plus.png"></td><td>neuer Teilnemer hinzufügen</td>
                        </tr>
                    </table>
                    <form action="<?php echo $GLOBALS["ROOT_URL"]; ?>/teilnehmer/neu" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>Reise</td>
                                <td>
                                    <select id="dropdown" name="reise">
                                        <?php
                                        //Abfrage für Reisetitel
                                        foreach (Service::getInstance()->getJourneyTitles() as $key => $journeyType) {
                                            echo "<option value='" . $journeyType['reise_id'] . "'>" . $journeyType['titel'] . ", " . $journeyType['reise_id'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Vorname</td>
                                <td><input type="text" name="vorname" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Nachname</td>
                                <td><input type="text" name="nachname" size="40px" /></td>
                            </tr>
                            <tr>
                                <td>Geburtsdatum</td>
                                <td><input type="date" name="geburtsdatum" size="40px" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" class="button" value="hinzuf&uuml;gen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
