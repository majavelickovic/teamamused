<!DOCTYPE html>
<!--
Diese Seite stellt die Rechnungs-Seite dar, wo man die Auswahl zwischen verschiedenen Optionen hat
@author Maja Velickovic
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Rechnung</title>
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
                            <td><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung/neu" ?>"><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/plus.png"></a></td><td><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung/neu" ?>" style="text-decoration: none;">neue Rechnung hinzufügen</a></td>
                        </tr>
                    </table>
                </div>
                <div id="blockright">
                    <table>
                        <tr>
                            <td><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung/bestehend" ?>"><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/search.png"></a></td><td><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung/bestehend" ?>" style="text-decoration: none;">bestehende Rechnung anzeigen</a></td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung/schlussabrechnung" ?>"><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/search.png"></a></td><td><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung/schlussabrechnung" ?>" style="text-decoration: none;">Schlussabrechnung anzeigen</a></td>
                        </tr>
                    </table>


                </div>
            </div>
        </div>
    </body>
</html>