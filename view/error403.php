<!DOCTYPE html>
<!--
Diese Seite stellt die 403-Error-Seite dar.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
        <title>Login</title>
    </head>
    <body>		
        <div id="whiteblock">
            <div id="block">
                <div id="blockleft">
                    <h1>403 Error!  <i class="em em-point_up"></i></h1>
                    <h2>Du hast keinen Zugriff! Melde dich zuerst an...</h2>
                    <img src="<?php echo $GLOBALS["ROOT_URL"]; ?>/design/pictures/403-forbidden.jpg">
                    <br><br>
                    <a href="<?php echo $GLOBALS["ROOT_URL"] . "/login" ?>">Hier gelangst du zur Login-Seite</a>
                </div>
            </div>
        </div>
    </body>
</html>

<?php

?>