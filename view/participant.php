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
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/reise" ?>">Reise</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung" ?>">Rechnung</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/teilnehmer" ?>">Teilnehmer</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/logout" ?>">Logout</a></li>
                    </ul>
                </div>
                <div id="blockleft">
					<table>
                        <tr>
                            <td><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/plus.png"></td><td>neue Teilnehmer hinzufügen</td>
                        </tr>
					</table>
                </div>
				<div id="blockright">
					<table>
                        <tr>
                            <td><img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/search.png"></td><td>bestehende Teilnehmer anzeigen</td>
                        </tr>
					</table>
                </div>
            </div>
        </div>
    </body>
</html>