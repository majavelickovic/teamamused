<!DOCTYPE html>
<!--
Diese Seite stellt die Willkommens-Seite dar.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Herzlich Willkommen</title>
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
                    <h1>Herzlich Willkommen</h1>
                    <!-- TODO wieder löschen -->
                    <?php echo session_id()?>
                </div>
            </div>
        </div>
    </body>
</html>

<?php

