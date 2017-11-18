<!DOCTYPE html>
<!--
Diese Seite stellt die 404-Error-Seite dar.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
        <title>Login</title>
    </head>
    <body>		
        <div id="whiteblock">
            <div id="block">
                <div id="blockleft">
                    <h1>404 Error!  <i class="em em-astonished"></i></h1>
                    <h2>Leider können wir die von dir gesuchte Seite nicht finden...</h2>
                    <a href="<?php echo $GLOBALS["ROOT_URL"] . "/login" ?>">Versuche es mir der Login-Seite</a>
                </div>
            </div>
        </div>
    </body>
</html>

<?php

?>