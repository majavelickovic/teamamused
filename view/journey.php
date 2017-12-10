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
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/reise" ?>">Reise</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/rechnung" ?>">Rechnung</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/teilnehmer" ?>">Teilnehmer</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT_URL"] . "/logout" ?>">Logout</a></li>
                    </ul>
                </div>
                <div id="blockleft">
                    <table>
                        <tr>
                            <td><a href="<?php echo $GLOBALS["ROOT URL"] . "/reise/neu" ?>"><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/plus.png"></a></td><td><a href="<?php echo $GLOBALS["ROOT URL"] . "/reise/neu" ?>" style="text-decoration: none;">neue Reise erstellen</a></td>
                        </tr>
                    </table>
                </div>
                <div id="blockright">
                    <table>
                        <tr>
                            <td><a href="<?php echo $GLOBALS["ROOT URL"] . "/reise/bestehend" ?>"><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/search.png"></a></td><td><a href="<?php echo $GLOBALS["ROOT URL"] . "/reise/bestehend" ?>" style="text-decoration: none;">bestehende Reise anzeigen</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>