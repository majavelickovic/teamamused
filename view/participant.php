<!DOCTYPE html>
<!--
Diese Seite stellt die Teilnehmer-Seite dar.
-->
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
                            <td><a href="<?php echo $GLOBALS["ROOT URL"] . "/teilnehmer/neu" ?>"><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/plus.png"></a></td><td><a href="<?php echo $GLOBALS["ROOT URL"] . "/teilnehmer/neu" ?>" style="text-decoration: none;">neue Teilnehmer hinzufügen</a></td>
                        </tr>
                    </table>
                </div>
                <div id="blockright">
                    <table>
                        <tr>
                            <td><a href="<?php echo $GLOBALS["ROOT URL"] . "/teilnehmer/bestehend" ?>"><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/search.png"></a></td><td><a href="<?php echo $GLOBALS["ROOT URL"] . "/teilnehmer/bestehend" ?>" style="text-decoration: none;">bestehende Teilnehmer anzeigen</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>